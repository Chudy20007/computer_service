<?php

namespace App\Http\Controllers;
use App\User;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\Order;
use App\OrderObject;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permissions');
    }

    public function showTaskForm ($id=null)
    {
        $employees = User::where('role','=','employee')->pluck('name','id');
        $orders = OrderObject::with('order')->get()->where('order.status','=','active')->pluck('name','order_id');
      
        return view('tasks.create_task')->with('orders', $orders)->with('employees', $employees)->with('id',$id);
    }

    public function storeTask (TaskRequest $request)
    {
 
      $request->request->add(['supervisor_id'=> Auth::id()]);
        $task = Task::create($request->toArray());
        return ("Success!");
    }

}
