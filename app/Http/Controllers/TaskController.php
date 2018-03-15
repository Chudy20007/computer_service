<?php

namespace App\Http\Controllers;
use App\User;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\Order;
use App\TaskMessage;
use App\OrderObject;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permissions', ['except' => ['storeTaskMessage', 'refreshTaskMessages','showTaskDetails']]);
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

    public function showTasksList()
    {   $tasks = Task::with('employee','supervisor','order')->get();
    
        return view('tasks.tasks_list')->with('tasks', $tasks);
    }

    public function showTaskDetails($id)
    {
        $task_messages = TaskMessage::where('task_id',$id)->with('employee','order','task')->orderBy('updated_at','desc')->get();
     
        return view('tasks.task_messages_list')->with('task_messages',$task_messages);
    }

    public function storeTaskMessage(Request $request)
    {
       
        $task = TaskMessage::create($request->toArray()); 
     
        $content="";
    $user_name = Auth::user()->getName();

        return json_encode("<div class='div-comments text-left'>
        <blockquote class='mycode_quote'>
            <cite>
                <span> ($task->updated_at)</span>
                <a href='/user/$task->employee_id' class='quick_jump'>
                    <img class='small-img' src='css/img/avatars/$task->employee_id.jpg'>$user_name</a> wrote: $task->message </cite>
        </blockquote>


    </div>");

    }

    public function refreshTaskMessages(Request $request)
    {
       
        $tasks = TaskMessage::with('employee')->where('task_id','=',$request->task_id)->orderBy('updated_at','desc')->get(); 
   
        $content="";


    foreach ($tasks as $task)
    {
        $user_name=$task->employee->name;
        $content.=
       ("<div class='div-comments text-left'>
        <blockquote class='mycode_quote'>
            <cite>
                <span> ($task->updated_at)</span>
                <a href='/user/$task->employee_id' class='quick_jump'>
                    <img class='small-img' src='css/img/avatars/$task->employee_id.jpg'></a>$user_name wrote: $task->message </cite>
        </blockquote>


    </div>");
    }
   
    return json_encode ($content);
    }

}
