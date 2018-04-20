<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderServiceRequest;
use App\Order;
use App\OrderObject;
use App\OrderPart;
use App\OrderService;
use App\Part;
use App\Service;
use App\User;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Swift_Attachment;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['sendBasicMail','findOrders', 'showMessageForm', 'sendMessage', 'storeOrderServices','storeOrder']]);
    }


public function findOrders()
{
    $data = json_decode(file_get_contents('php://input'), true);

    $data['data'] = htmlentities($data['data']);
    $data['data'] = stripslashes($data['data']);
    if (Auth::user()->isCustomer())
    {
    $orders = Order::with('customer','employee')->leftJoin('users','orders.customer_id','=','users.id')
    ->where('orders.customer_id','=',Auth::id())->where('orders.id', '=' ,$data['data'])->get();
    $orders_id = Order::where('orders.id', 'LIKE', '%' . $data['data'] . '%')->get(['id','created_at','updated_at']);

    $orders[0]->id = $orders_id[0]->id;
    $orders[0]->created_at = $orders_id[0]->created_at;
    $orders[0]->updated_at = $orders_id[0]->updated_at;
    }
    else
   $orders = Order::with('customer','employee')->leftJoin('users','orders.customer_id','=','users.id')
   ->where('users.name', 'LIKE', '%' . $data['data'] . '%')->get();  

    $token=$data['token'];
    $content = "";


    switch (Auth::user()->getRole())
    {
        case "admin":
        {
            $content = $this->getSearchingResultsAdmin($orders);
            return json_encode($content);
        }

        case "supervisor":
        {
            $content = $this->getSearchingResultsSupervisor($orders);
            return json_encode($content);
        }

        case "employee":
        {
            $content = $this->getSearchingResultsEmployee($orders);
            return json_encode($content);
        }
        case "customer":
        {
            $content = $this->getSearchingResultsCustomer($orders);
            return json_encode($content);
        }
    }

}


public function sortOrders()
{
    $data = json_decode(file_get_contents('php://input'), true); 
    $data['column_name'] = htmlentities($data['column_name']);
    $data['column_name'] = stripslashes($data['column_name']);
    $data['table_name'] = htmlentities($data['table_name']);
    $data['table_name'] = stripslashes($data['table_name']);
    $data['data_sort'] = htmlentities($data['data_sort']);
    $data['data_sort'] = stripslashes($data['data_sort']);
    if (Auth::user()->isCustomer())
    {
        $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')->where('orders.customer_id','=',Auth::id())
        ->orderBy('orders.'.$data['column_name'], $data['data_sort'])
        ->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'created_at', 'id']);
    }
    if(Auth::user()->isSupervisor() || Auth::user()->isAdmin())
    {
       if($data['column_name']=='email' || $data['column_name']=='phone' 
       || $data['column_name']=='employee_id' || $data['column_name']=='cusotomer_id')
           $sort='users.';
        else
        $sort='orders.';
   $orders = Order::with('customer','employee')
   ->leftJoin('users','orders.customer_id','=','users.id')
   ->orderBy($sort.$data['column_name'], $data['data_sort'])
   ->get(['status', 'employee_id','orders.active', 'customer_id', 'description','email','phone', 'orders.updated_at', 'orders.created_at', 'orders.id']); 


    }

    if(Auth::user()->isEmployee())
    {
       if($data['column_name']=='email' || $data['column_name']=='phone' 
       || $data['column_name']=='employee_id' || $data['column_name']=='cusotomer_id')
           $sort='users.';
        else
        $sort='orders.';
   $orders = Order::with('customer','employee')
   ->leftJoin('users','orders.customer_id','=','users.id')
   ->where('employee_id','=',Auth::id())
   ->where('status','!=','closed')
   ->orderBy($sort.$data['column_name'], $data['data_sort'])
   ->get(['status', 'employee_id', 'customer_id', 'description','email','phone', 'orders.updated_at', 'orders.created_at', 'orders.id']); 


    }
    switch (Auth::user()->getRole())
    {
        case "admin":
        {
            $content = $this->getSearchingResultsAdmin($orders);
            return json_encode($content);
        }

        case "supervisor":
        {
            $content = $this->getSearchingResultsSupervisor($orders);
            return json_encode($content);
        }

        case "employee":
        {
            $content = $this->getSearchingResultsEmployee($orders);
            return json_encode($content);
        }
        case "customer":
        {
            $content = $this->getSearchingResultsCustomer($orders);
            return json_encode($content);
        }
    }
}


public function getSearchingResultsSupervisor($orders)
{
    $content="";
    foreach ($orders as $order) {
        $employee_name = $order->employee->name;
      $customer_name = $order->customer->name;
$content.=("
<tr class='table-light'>
<td>
  <a href='http://localhost/computer_service/public/order/$order->id'>$order->id</a>
</td>
<td>
  <a href='http://localhost/computer_service/public/user/$order->customer_id'>$customer_name</a>
</td>
<td>$order->email</td>
<td> $order->phone</td>
<td> $order->status</td>
<td> $order->description</td>
<td> $employee_name</td>
<td> <form method='GET' action='http://localhost/computer_service/public/create_task/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value=Utwórz wątek> </form> </a>
    </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/edit_order/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Edytuj zlecenie'> </form> </a>
   
    </td>
</tr>


");

  }
  return $content;
}
public function getSearchingResultsEmployee($orders)
{
    $content="";
    foreach ($orders as $order) {
        $employee_name = $order->employee->name;
      $customer_name = $order->customer->name;
$content.=("
<tr class='table-light'>
<td>
  <a href='http://localhost/computer_service/public/order/$order->id'>$order->id</a>
</td>
<td>
  <a href='http://localhost/computer_service/public/user/$order->customer_id'>$customer_name</a>
</td>
<td>$order->email</td>
<td> $order->phone</td>
<td> $order->status</td>
<td> $order->description</td>
<td> $employee_name</td>
<td> <form method='GET' action='http://localhost/computer_service/public/edit_order/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Edytuj zlecenie'> </form> </a>
   
    </td>
<td> <form method='GET' action='http://localhost/computer_service/public/show_order_services/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-contro'' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż usługi'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_parts/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż części'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_objects/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż przedmioty'> </form> </a>
  </td>
</tr>


");

  }
  return $content;
}

public function getSearchingResultsCustomer($orders)
{
   
    $content="";
    foreach ($orders as $order) {
        $employee_name = $order->employee->name;
      $customer_name = $order->customer->name;
$content.=("
<tr class='table-light'>
<td>
  <a href='http://localhost/computer_service/public/order/$order->id'>$order->id</a>
</td>
<td> $order->status</td>
<td> $order->description</td>
<td> $employee_name</td>
<td> $order->created_at</td>
<td> $order->updated_at</td>
<td> <form method='GET' action='http://localhost/computer_service/public/show_order_services/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-contro'' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż usługi'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_parts/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż części'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_objects/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż przedmioty'> </form> </a>
  </td>
</tr>


");

  }
  return $content;
}

public function getSearchingResultsAdmin($orders)
{
    $content="";
    foreach ($orders as $order) {
        $employee_name = $order->employee->name;
      $customer_name = $order->customer->name;
$content.=("
<tr class='table-light'>
<td>
  <a href='http://localhost/computer_service/public/order/$order->id'>$order->id</a>
</td>
<td>
  <a href='http://localhost/computer_service/public/user/$order->customer_id'>$customer_name</a>
</td>
<td>$order->email</td>
<td> $order->phone</td>
<td> $order->status</td>
<td>".($order->active == 1 ? 'tak' : 'nie')."</td>
<td> $order->description</td>
<td> $employee_name</td>
<td> <form method='GET' action='http://localhost/computer_service/public/create_task/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Utwórz wątek'> </form> </a>
    </td>

<td> <form method='GET action='http://localhost/computer_service/public/show_order_services/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-contro'' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż usługi'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_parts/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż części'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/show_order_objects/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Pokaż przedmioty'> </form> </a>
  </td>
  <td> <form method='GET' action='http://localhost/computer_service/public/edit_order/$order->id' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'> <input class='btn btn-primary' type='submit' value='Edytuj zlecenie'> </form> </a>
   
    </td>
    <td> <form method='POST' action='http://localhost/computer_service/public/activate_order' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'><input class='form-control' name='_method' type='hidden' value='PATCH'> <input class='btn btn-primary' type='submit' value='Aktywuj zlecenie'> </form> </a>
     
        </td>
        <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_order' accept-charset='UTF-8' class='form-horizontal'> <input class='form-control' name='id' type='hidden' value='$order->id'><input class='form-control' name='_method' type='hidden' value='DELETE'> <input class='btn btn-primary' type='submit' value='Usuń zlecenie'> </form> </a>
            </td>
</tr>


");

  }
  return $content;
}
    public function storeOrder(OrderRequest $request)
    {

        $user = User::where('name', $request['name'])
            ->orWhere('email', $request['email'])->get(['id']);

        if ($user->isEmpty()) {
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->post_code = $request['post-code'];
            $user->city = $request['city'];
            $user->street = $request['street'];
            $user->local_number = $request['local-number'];
            $user->phone = $request['phone'];
            $user->password = bcrypt($request['name']);
            $user->save();
        } else {
            $user->id = $user[0]->id;
        }
        if(Auth::user())
    {
if (Auth::user()->getRole()==="employee")
$user_id = Auth::id();
else $user_id=1;
    }
    else $user_id=1;

        foreach ($request['device'] as $device) {
            $orders[] =
                [
                'customer_id' => $user->id,
                'employee_id' => $user_id,
                'description' => $request['description'],
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        Order::insert($orders);
        $order_id = Order::get(['id'])->last();

        $order_id = $order_id->id - count($request['device']) + 1;

        foreach ($request['device'] as $device) {
            $devices[] =
                [
                'order_id' => $order_id,
                'name' => $device,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $order_id++;
        }

        OrderObject::insert($devices);
        Session::put('message', 'Zlecenie zostało pomyślnie utworzone!');
        return view("main");

    }

    public function showServicesOrderForm($id = null)
    {
        $order = Order::where('id', $id)->get()->first();

        if ($order->status == "closed") {
            return view("user.order_closed");
        }
        $services = Service::where('active', '=', true)->pluck('name', 'id', 'price');

        $orders = OrderObject::where('fixed', '=', false)->pluck('name', 'order_id');

        return view('orders.add_services_to_order')->with('order_id', $id)->with('orders', $orders)->with('services', $services);
    }
    public function storeOrderServices(OrderServiceRequest $request)
    {
        $order = Order::where('id', $request->order_id)->get()->first();

        if ($order->status == "closed") {
            return view("user.order_closed");
        }

        foreach ($request->service_id as $service_id) {
            $datas[] = [
                'order_id' => $request->order_id,
                'service_id' => $service_id,

            ];
        }

        OrderService::insert($datas);
        Session::put('message', 'Usługi zostały pomyślnie dodane do zlecenia!');
        return redirect("show_orders");
    }

    public function showPartsOrderForm($id = null)
    {
        $order = Order::where('id', $id)->get()->first();

        if ($order->status == "closed") {
            return view("user.order_closed");
        }

        $parts = Part::where('count', '>', 0)->pluck('name', 'id');

        $orders = OrderObject::where('fixed', '=', false)->pluck('name', 'order_id');

        return view('orders.add_parts_to_order')->with('order_id', $id)->with('orders', $orders)->with('parts', $parts);
    }
    public function storeOrderParts(Request $request)
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $selected_part = Part::where('id', '=', $data['part_id'])->get(['count']);

        if ($data['count'] > $selected_part[0]->count && !$selected_part->isEmpty()) {
            return json_encode("<div class='row alert alert-warning card text-center'><b>Brak dostatecznej ilości sztuk! </b></div>");
        }

        $order = OrderPart::where('part_id', '=', $data['part_id'])
        ->where('order_id','=',$data['order_id'])->where('active','=',true)->get(['count']);
        if (!$order->isEmpty()) {
            Part::where('id', '=', $data['part_id'])->decrement('count', $data['count']);
            $count = $order[0]->count;
            $data['count'] += $count;
            OrderPart::where('part_id', '=', $data['part_id'])->where('order_id','=',$data['order_id'])->where('active','=',true)->update([
                'count' => $data['count'],
            ]);

        } else {
            Part::where('id', '=', $data['part_id'])->decrement('count', $data['count']);
           
            OrderPart::insert($data);
        }

        return json_encode("<div class='row alert alert-success card text-center'><b>Części zostały dodane do zlecenia!</b></div>");
    }

    public function showOrdersList()
    {

        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
                     ->where('orders.status', '!=', 'closed') ->where('orders.employee_id', '=', Auth::id())->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'created_at', 'id']);

                    return view('orders.orders_list_e')->with('orders', $orders);
                }

            case "supervisor":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
                        ->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'created_at', 'id']);

                    return view('orders.orders_list_s')->with('orders', $orders);
                }

            case "admin":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
                        ->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'active', 'created_at', 'id']);

                    return view('orders.orders_list_a')->with('orders', $orders);
                }
                case "customer":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')->where('orders.customer_id','=',Auth::id())
                        ->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'created_at', 'id']);

                    return view('orders.orders_list_c')->with('orders', $orders);
                }
            default:
                {
                    return view('pictures.access_denied');

                }

        }

    }

    public function showOrder($id)
    {
        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
                    /*  ->where('status', '!=', 'closed') */
                        ->where('id', '=', $id)
                        ->where('employee_id', '=', Auth::id())->latest()->get();
                        
                    if ($orders->isEmpty()) {
                        return view('user.access_denied');
                    } else {
                        return view('orders.show_order')->with('orders', $orders);
                    }

                }

            case "supervisor":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')

                        ->where('id', '=', $id)->get();

                    return view('orders.show_order')->with('orders', $orders);
                }

            case "admin":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')

                        ->where('id', '=', $id)->get();

                    return view('orders.show_order')->with('orders', $orders);
                }
                case "customer":
                {
                    $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')

                        ->where('id', '=', $id)->where('customer_id','=',Auth::id())->get();
                    return view('orders.show_order_c')->with('orders', $orders);
                }

            default:
                {
                    return view('user.access_denied');

                }
        }
    }

    public function showUserOrdersList($id)
    {
        $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
            ->where('customer_id', '=', $id)
            ->get(['status', 'employee_id', 'customer_id', 'description', 'updated_at', 'created_at', 'id']);

        return view('orders.user_orders_list')->with('orders', $orders);
    }

    public function showOrderEditForm($id)
    {
        $orders = Order::where('id', '=', $id)->get();

        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    if ($orders[0]->employee_id == Auth::id()) {
                        return view('orders.edit_order_e')
                            ->with('order', $orders);
                    } else {
                        return view('user.access_denied');
                    }

                    break;
                }

            case "supervisor":
                {
                    $employees = User::where('role', '=', 'supervisor')->orWhere('role', '=', 'employee')->pluck('name', 'id');

                    $customers = User::pluck('name', 'id');
                    return view('orders.edit_order')
                        ->with('order', $orders)
                        ->with('customers', $customers)
                        ->with('employees', $employees);
                    break;
                }

            case "admin":
                {
                    $employees = User::where('role', '=', 'supervisor')->orWhere('role', '=', 'employee')->pluck('name', 'id');

                    $customers = User::pluck('name', 'id');
                    return view('orders.edit_order')
                        ->with('order', $orders)
                        ->with('customers', $customers)
                        ->with('employees', $employees);
                    break;
                }
        }

    }

    public function editOrder(Request $request)
    {
        $data = $request->all();

        Order::where('id', '=', $data['order_id'])->update([
            'id' => $data['order_id'],
            'customer_id' => $data['customer_id'],
            'employee_id' => $data['employee_id'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
        
        Session::put('message', 'Zlecenie zostało pomyślnie zaktualizowane!');
        return redirect('show_orders');
    }

    public function showOrderObjectsEditForm($id)
    {

        $objects = OrderObject::where('order_id', '=', $id)->get();

        return view('orders.edit_order_objects')->with('objects', $objects);
    }

    public function editOrderObjects(Request $request)
    {$data = $request->all();
        $ob = OrderObject::where('order_id', '=', $data['id'])->get()->first();
        $ob_id = $ob->id;

        do {
            if (isset($data['object_id' . $ob_id])) {
                OrderObject::where('id', '=', $data['object_id' . $ob_id])->update([

                    'serial_number' => $data['serial_number' . $ob_id],
                    'fixed' => $data['fixed' . $ob_id],
                    'diagnosis' => $data['diagnosis' . $ob_id],
                    'name' => $data['name' . $ob_id],
                ]);
            }
            $ob_id++;
        } while (isset($data['object_id' . $ob_id]));

        $orders = Order::with('customer', 'employee', 'order_object', 'order_part', 'order_service')
            ->where('status', '=', 'active')
            ->where('id', '=', $data['id'])->get();
        Session::put('message', 'Przedmioty zostały zaktualizowane!');
        return redirect('show_order_objects/' . $data['id'])->with('id', $data['id']);
    }
    public function showOrderObjectsList($id)
    {
        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $objects = OrderObject::where('order_id', '=', $id)->where('active', '=', true)->get();

                    return view('orders.order_objects_list_e')->with('objects', $objects);
                }

            case "supervisor":
                {
                    $objects = OrderObject::where('order_id', '=', $id)->get();

                    return view('orders.order_objects_list')->with('objects', $objects);
                    break;
                }

            case "admin":
                {
                    $objects = OrderObject::where('order_id', '=', $id)->get();

                    return view('orders.order_objects_list')->with('objects', $objects);
                    break;
                }

                case "customer":
                {
                    $objects = OrderObject::where('order_id', '=', $id)->get();

                    return view('orders.order_objects_list_c')->with('objects', $objects);
                    break;
                }

                default:
                {
                    return view('users.access_denied');
                }
        }

    }

    public function showOrderPartsList($id)
    {
        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $parts = OrderPart::with('part')->where('order_id', '=', $id)->where('active', '=', true)->get();

                    return view('orders.order_parts_list_e')->with('parts', $parts);
                }

            case "supervisor":
                {
                    $parts = OrderPart::with('part')->where('order_id', '=', $id)->get();

                    return view('orders.order_parts_list')->with('parts', $parts);
                    break;
                }

            case "admin":
                {
                    $parts = OrderPart::with('part')->where('order_id', '=', $id)->get();

                    return view('orders.order_parts_list')->with('parts', $parts);
                    break;
                }
                
            case "customer":
            {
                $parts = OrderPart::with('part')->where('order_id', '=', $id)->get();

                return view('orders.order_parts_list_c')->with('parts', $parts);
                break;
            }

            default:
            {
                return view('users.access_denied');
            }
        }

    }

    public function showOrderServicesList($id)
    {
        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $services = OrderService::with('service')->where('order_id', '=', $id)->where('active', '=', true)->get();
                    return view('orders.order_services_list_e')->with('services', $services);
                }

            case "supervisor":
                {
                    $services = OrderService::with('service')->where('order_id', '=', $id)->get();
                    return view('orders.order_services_list')->with('services', $services);
                    break;
                }

            case "admin":
                {
                    $services = OrderService::with('service')->where('order_id', '=', $id)->get();
                    return view('orders.order_services_list')->with('services', $services);
                    break;
                }
                case "customer":
                {
                    $services = OrderService::with('service')->where('order_id', '=', $id)->get();
                    return view('orders.order_services_list_c')->with('services', $services);
                    break;
                }
        }

    }

    public function showMessageForm($id)
    {

        return view('orders.send_message')->with('user_id', $id);
    }

    public function sendMessage(Request $request)
    {

        $datas = $request->all();
        $email = User::where('id', $datas['user_id'])->get(['email']);
        $content = "<h3>Szanowny Panie/Szanowna Pani,</h3><br />";
        $footer = "<br />Jeżeli są jakieś pytania to zachęcamy do kontaktu.<br /><h3>Z wyrazamu szacunku</h3><br />" . Auth::user()->getName();
        $files = Input::file('file');

        $datas['email'] = $email[0]->email;
        $em['email'] = $datas['email'];
        $em['content'] = $content . $datas['message'] . $footer;
        if ($files[0] != null) {
            //dd($files[0]->getClientOriginalName());

            switch (File::extension($files[0]->getClientOriginalName())) {
                case "jpg":
                    {
                        $em['path'] = $swiftAttachment = Swift_Attachment::fromPath($files[0]->getPathName())->setFilename($files[0]->getClientOriginalName());

                        Mail::send('mail', ['title' => "Wiadomość"], function ($m) use ($em) {

                            $m->to($em['email'])
                                ->from('computer_service@gmail.com', 'Computer Service')
                                ->subject('Zlecenie')
                                ->setBody($em['content'], 'text/html')
                                ->attach($em['path'], array('mime' => 'image/jpeg'));
                            return view("main");
                        });
                        break;
                    }

                case "pdf":
                    { $em['path'] = $swiftAttachment = Swift_Attachment::fromPath($files[0]->getPathName())->setFilename('Invoice ' . Carbon::now() . '.pdf');

                        Mail::send('mail', ['title' => "Aktualizacja zlecenia"], function ($m) use ($em) {

                            $m->to($em['email'])
                                ->from('computer_service@gmail.com', 'Computer Service')
                                ->subject('Zlecenie zaktualizowane')
                                ->setBody($em['content'], 'text/html')
                                ->attach($em['path'], array('mime' => 'application/pdf'));
                            return view("main");
                        });
                        break;
                    }

                default:
                    {
                        Session::put('message',"Niewłaściwy format pliku! Obsługiwane typy: pdf oraz jpg.");
                        return view('orders.send_message')->with('user_id', $datas['user_id']);
                    }

            }

        } else {
            Mail::send('mail', ['title' => "Zlecenie zaktualizowane"], function ($m) use ($em) {

                $m->to($em['email'])
                    ->from('computer_service@gmail.com', 'Computer Service')
                    ->subject('Zlecenie zaktualizowane')
                    ->setBody($em['content'], 'text/html');

                return view("main");
            });
        }
        Session::put('message', 'Wiadomość została pomyślnie wysłana!');
        return view("main");
    }

}
