<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
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

        $user->id = $user[0]->id;

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
        $services = Service::where('is_active', '=', true)->pluck('name', 'id', 'price');

        $orders = OrderObject::where('fixed', '=', false)->pluck('name', 'order_id');

        return view('orders.add_services_to_order')->with('order_id', $id)->with('orders', $orders)->with('services', $services);
    }
    public function storeOrderServices(Request $request)
    {

        foreach ($request->service_id as $service_id) {
            $datas[] = [
                'order_id' => $request->order_id, 'service_id' => $service_id,
                //...
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
        $orders = Order::with('customer','employee','order_object','order_part','order_service')->where('status','=','active')->get(['status','employee_id','customer_id','description','updated_at','created_at','id']);

        return view ('orders.orders_list')->with('orders',$orders);
    }
}
