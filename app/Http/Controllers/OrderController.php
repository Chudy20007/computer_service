<?php

namespace App\Http\Controllers;
use Swift_Attachment;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderServiceRequest;
use App\Order;
use Mail;
use Auth;
use App\OrderObject;
use App\OrderPart;
use App\OrderService;
use App\Part;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        }
        else
        $user->id = $user[0]->id;
        $order = new Order;
        $order->customer_id = $user->id;
        $order->employee_id = 1;
        $order->description = $request['description'];
        $order->updated_at = date('Y-m-d H:i:s');
        $order->created_at = date('Y-m-d H:i:s');

        $order->save();

        foreach ($request['device'] as $device) {
            $devices[] =
                [
                'order_id' => $order->id,
                'name' => $device,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        OrderObject::insert($devices);

        return "AAA";

    }

    public function showServicesOrderForm($id = null)
    {
        $services = Service::where('active', '=', true)->pluck('name', 'id', 'price');

        $orders = OrderObject::where('fixed', '=', false)->pluck('name', 'order_id');

        return view('orders.add_services_to_order')->with('order_id', $id)->with('orders', $orders)->with('services', $services);
    }
    public function storeOrderServices(OrderServiceRequest $request)
    {
 
        foreach ($request->service_id as $service_id) {
            $datas[] = [
                'order_id' => $request->order_id, 
                'service_id' => $service_id,
            
            ];
        }

        OrderService::insert($datas);
        return ("Success!");
    }

    public function showPartsOrderForm($id = null)
    {
        $parts = Part::where('count', '>', 0)->pluck('name', 'id');

        $orders = OrderObject::where('fixed', '=', false)->pluck('name', 'order_id');

        return view('orders.add_parts_to_order')->with('order_id', $id)->with('orders', $orders)->with('parts', $parts);
    }
    public function storeOrderParts(Request $request)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $selected_part = Part::where('id', '=', $data['part_id'])->get(['count']);

        if ($data['count'] > $selected_part[0]->count && !$selected_part->isEmpty()) {
            return json_encode("<div class='row alert alert-warning card text-center'><b>Too little parts! </b></div>");
        }

        $order = OrderPart::where('part_id', '=', $data['part_id'])->get(['count']);
        if (!$order->isEmpty()) {
            Part::where('id', '=', $data['part_id'])->decrement('count', $data['count']);
            $count = $order[0]->count;
            $data['count'] += $count;
            OrderPart::where('part_id', '=', $data['part_id'])->update([
                'count' => $data['count'],
            ]);

        } else {
            Part::where('id', '=', $data['part_id'])->decrement('count', $data['count']);
            OrderPart::insert($data);
        }

        return json_encode("<div class='row alert alert-success card text-center'><b>Parts has been added to the order!</b></div>");
    }

    public function showOrdersList()
    {

        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $orders = Order::with('customer','employee','order_object','order_part','order_service')
                ->where('status','=','active')->get(['status','employee_id','customer_id','description','updated_at','created_at','id']);

        return view ('orders.orders_list_e')->with('orders',$orders);              
            }

            case "supervisor":
            {
                $orders = Order::with('customer','employee','order_object','order_part','order_service')
                ->get(['status','employee_id','customer_id','description','updated_at','created_at','id']);

        return view ('orders.orders_list_s')->with('orders',$orders);              
            }

            case "admin":
            {
                $orders = Order::with('customer','employee','order_object','order_part','order_service')
                ->get(['status','employee_id','customer_id','description','updated_at','active','created_at','id']);

        return view ('orders.orders_list_a')->with('orders',$orders);                
            }

            default:
            {
              return view('pictures.access_denied');
                 
            }

        }
        
       
    }

    public function showOrder($id)
    {
        $orders = Order::with('customer','employee','order_object','order_part','order_service')
        ->where('status','=','active')
        ->where('id','=',$id)->get();

        return view ('orders.show_order')->with('orders',$orders);
    }
    
    public function showUserOrdersList($id)
    {
        $orders = Order::with('customer','employee','order_object','order_part','order_service')
     ->where('customer_id','=',$id)
        ->get(['status','employee_id','customer_id','description','updated_at','created_at','id']);

        return view ('orders.user_orders_list')->with('orders',$orders);
    }

    public function showOrderEditForm($id)
    {
        $employees = User::where('role', '=', 'supervisor')->orWhere('role', '=', 'employee')->pluck('name', 'id');

        $customers = User::pluck('name', 'id');
        $orders = Order::where('id','=',$id)->get();

        return view ('orders.edit_order')->with('order',$orders)->with('customers',$customers)->with('employees',$employees);
    }

    public function editOrder(Request $request)
    {
        $data =$request->all();
        
        Order::where('id', '=', $data['order_id'])->update([
            'id' => $data['order_id'],
            'customer_id' => $data['customer_id'],
            'employee_id' => $data['employee_id'],
            'description' => $data['description'],
            'status' => $data['status']
        ]);
        $orders = Order::with('customer','employee','order_object','order_part','order_service')
        ->where('status','=','active')
        ->get(['status','employee_id','customer_id','description','updated_at','created_at','id']);

        return view ('orders.show_order')->with('orders',$orders);
    }

    public function showOrderObjectsEditForm($id)
    {
      
        $objects = OrderObject::where('order_id','=',$id)->get();
       
        return view ('orders.edit_order_objects')->with('objects',$objects);
    }    


    public function editOrderObjects(Request $request)
    { $data =$request->all();

        $count = (count($data)-2)/5;
        

        for ($i=1; $i<=2; $i++)
        {
            OrderObject::where('id', '=', $data['object_id'.$i])->update([

                'serial_number' => $data['serial_number'.$i],
                'fixed' => $data['fixed'.$i],
                'diagnosis' => $data['diagnosis'.$i],
                'name' => $data['name'.$i]
            ]);  
        }

        $orders = Order::with('customer','employee','order_object','order_part','order_service')
        ->where('status','=','active')
        ->where('id','=',$data['id'])->get();

        return view ('orders.show_order')->with('orders',$orders);
    }
    public function showOrderObjectsList($id)
    {
      
        $objects = OrderObject::where('order_id','=',$id)->get();
       
        return view ('orders.order_objects_list')->with('objects',$objects);
    }   

    public function showOrderPartsList($id)
    {
      
        $parts = OrderPart::with('part')->where('order_id','=',$id)->where('active','=',true)->get();
       
        return view ('orders.order_parts_list')->with('parts',$parts);
    }   

    public function showOrderServicesList($id)
    {
      
        $services = OrderService::with('service')->where('order_id','=',$id)->where('active','=',true)->get();
        return view ('orders.order_services_list')->with('services',$services);
    }   

    public function showMessageForm($id)
    {
      
        return view('orders.send_message')->with('user_id',$id);
    }

    public function sendMessage(Request $request)
    {
        $datas=$request->all();
        $email = User::where('id',$datas['user_id'])->get(['email']);


$datas['email']=$email[0]->email;
$em['email']=$datas['email'];
$em['content']=$datas['message'];
$em['path']=$swiftAttachment = Swift_Attachment::fromPath("C:/Users/Krystian/Desktop/a.pdf");

        Mail::send('mail', ['title'=>"Order status1 updated"], function($m) use ($em) {
           

            $m->to($em['email'])
            ->from('computer_service@gmail.com','Computer Service')
            ->subject('Order status updated')
            ->setBody($em['content'],'text/html');
          //  ->attach($em['path'], array('as' => 'invoice.pdf', 'mime' => 'LONGTEXT'));
            return "Send";
        });
      }


     


}
