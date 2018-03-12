<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderObject;

class OrderController extends Controller
{
    public function store (OrderRequest $request)
    { 
      
       $user = User::where('name',$request['name'])
       ->orWhere('email',$request['email'])->get(['id']);
      
        $user->id = $user[0]->id;

       if ($user->isEmpty())
       {
         $user = new User;
         $user->name = $request['name'];
         $user->email = $request['email'];
         $user->post_code = $request['post-code'];
         $user->city = $request['city'];
         $user->street =$request['street'];
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
       
        foreach ($request['device'] as $device)
        {
            $devices[]=
            [
                'order_id'=> $order->id,
                'name' => $device,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        
        OrderObject::insert($devices);
        
        return "AAA";
       
    }
}
