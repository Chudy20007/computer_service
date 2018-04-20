<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\OrderObject;
use App\Task;
use App\TaskMessage;
use App\User;
use Session;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions', ['except' => ['findTasks','sortTasks','storeTaskMessage','showTaskForm','storeTask', 'refreshTaskMessages', 'showTasksList', 'showTaskDetails']]);
    }

    public function showTaskForm($id)
    {
        $order = Order::where('id','=',$id)->get()->first();
     
        if ($order->status=="closed")
        {
            return view ("user.order_closed");
        }

        $employees = User::where('role', '=', 'employee')->pluck('name', 'id');
        $orders = OrderObject::with('order')->get()->where('order.status', '=', 'active')->pluck('name', 'order_id');

        return view('tasks.create_task')->with('orders', $orders)->with('employees', $employees)->with('id', $id);
    }

    public function showTaskEditForm($id)
    {
        $employees = User::where('role', '!=', 'customer')->where('role','!=','admin')->pluck('name', 'id');
        $orders = OrderObject::with('order')->get()->where('order.status', '=', 'active')->pluck('name', 'order_id');
        $task = Task::where('id', $id)->get()->first();
       
        return view('tasks.edit_task')->with('orders', $orders)->with('employees', $employees)->with('id', $id)->with('task', $task);
    }

    public function editTask(TaskRequest $request)
    {

        $id = $request->id;
        $task = [
            'title' => $request->title,
            'order_id' => $request->order_id,
            'employee_id' => $request->employee_id,
            'message' => $request->message,
            'supervisor_id' => $request->supervisor_id,
        ];

        Task::where('id', $id)->update($task);
        Session::put('message', 'Wątek został pomyślnie zaktualizowany!');
        return redirect("show_tasks");
    }

    public function storeTask(TaskRequest $request)
    {

        $request->request->add(['supervisor_id' => Auth::id()]);
        $task = Task::create($request->toArray());
        Session::put('message', 'Wątek została pomyślnie dodany!');
        return redirect ("show_tasks");
    }

    public function showTasksList()
    {

        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $tasks = Task::with('employee', 'supervisor', 'order')->where('tasks.active', '=', true)->where('tasks.employee_id', '=', Auth::id())->get();

                    return view('tasks.tasks_list_e')->with('tasks', $tasks);
                }

            case "supervisor":
                {
                    $tasks = Task::with('employee', 'supervisor', 'order')->where('active', '=', true)->get();

                    return view('tasks.tasks_list_s')->with('tasks', $tasks);
                }

            case "admin":
                {
                    $tasks = Task::with('employee', 'supervisor', 'order')->get();

                    return view('tasks.tasks_list_a')->with('tasks', $tasks);
                }

            default:
                {
                    return redirect('user.access_denied');

                }

        }

    }

    public function showTaskDetails($id)
    {
        switch (Auth::user()->getRole()) {
            case "employee":
                {

                    $task_messages = TaskMessage::where('task_id', $id)->with('employee', 'order', 'task')->orderBy('updated_at', 'desc')->get();
                    $task = Task::where('id',$id)->get()->first();
                   
                    $hiddenValues=[
                       'task_id'=> $id,
                       'user_id' => Auth::id(),
                       'order_id' =>$task->order_id
                   ];
                        return view('tasks.task_messages_list')->with('task_messages', $task_messages)->with('hiddenValues',$hiddenValues);
                    

                }

            case "supervisor":
                {

                    $task_messages = TaskMessage::where('task_id', $id)->with('employee', 'order', 'task')->orderBy('updated_at', 'desc')->get();

                    return view('tasks.task_messages_list')->with('task_messages', $task_messages);
                }

            case "admin":
                {

                    $task_messages = TaskMessage::where('task_id', $id)->with('employee', 'order', 'task')->orderBy('updated_at', 'desc')->get();

                    return view('tasks.task_messages_list')->with('task_messages', $task_messages);
                }

            default:
                {
                    return redirect('user.access_denied');

                }

        }

    }
    public function findTasks()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data['data'] = htmlentities($data['data']);
        $data['data'] = stripslashes($data['data']);
       
      
        switch(Auth::user()->getRole())
        {
            case 'admin':
            {   
                $user = User::where('name', 'LIKE', '%' . $data['data'] . '%')->get()->first();
                
                $tasks = Task::with('employee','supervisor')->where('supervisor_id', 'LIKE', '%' . $user->id . '%')->orWhere('supervisor_id', 'LIKE', '%' . $user->id . '%')->get();
                $content=$this->getSearchingResultsAdmin($tasks);
                break;
            }
            case 'employee':
            {
                $tasks = Task::with('employee','supervisor')->where('name', 'LIKE', '%' . $data['data'] . '%')->where('active','=',true)->get();
                $content=$this->getSearchingResultsEmployee($tasks);
                break;
            }
            case 'supervisor':
            {
                $tasks = Task::with('employee','supervisor')->where('name', 'LIKE', '%' . $data['data'] . '%')->get();
                $content=$this->getSearchingResultsSupervisor($tasks);
                break;
            }
            case 'customer':
            {

                break;
            }
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }








    public function storeTaskMessage(Request $request)
    {

        $task = TaskMessage::create($request->toArray());

        $content = "";
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
    public function sortTasks()
    {
        $data = json_decode(file_get_contents('php://input'), true); 
        $data['column_name'] = htmlentities($data['column_name']);
        $data['column_name'] = stripslashes($data['column_name']);
        $data['table_name'] = htmlentities($data['table_name']);
        $data['table_name'] = stripslashes($data['table_name']);
        $data['data_sort'] = htmlentities($data['data_sort']);
        $data['data_sort'] = stripslashes($data['data_sort']);


         $sort='tasks.';
        switch(Auth::user()->getRole())
        {
            case 'admin':
            {
                $tasks = Task::with('order','employee','supervisor')->orderBy($sort.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsAdmin($tasks);
                break;
            }
            case 'employee':
            {
                $tasks = Task::with('order','employee','supervisor')->where('active',true)->orderBy($sort.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsEmployee($tasks);
                break;
            }
            case 'supervisor':
            {
                $tasks = Task::with('order','employee','supervisor')->orderBy($sort.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsSupervisor($tasks);
                break;
            }
    
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }

    public function getSearchingResultsAdmin($tasks)
    {
        $content = "";
        foreach ($tasks as $task) {
            $supervisor=$task->supervisor->name;
            $employee=$task->employee->name;
            $order=$task->order->id;
            $employee=$task->employee->name;
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public/order/$order'>$order</a></td>
            <td>$task->title</td>
            <td>$supervisor</td>
            <td>$employee</td>
            <td>$task->message</td>
            <td>$task->created_at</td>
            <td>$task->updated_at</td>
            <td>".($task->active ? 'tak' : 'nie')."</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/show_task_details/$task->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$task->id'>
                 <input class='btn btn-primary' type='submit' value='Szczegóły'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_task/$task->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$task->id'>
                 <input class='btn btn-primary' type='submit' value='Edytuj'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td> 
                 <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_task' 
                    accept-charset='UTF-8' class='form-horizontal'> 
                    <input class='form-control' name='id' type='hidden' value='$task->id'>
                     <input class='btn btn-primary' type='submit' value='Dezaktywuj'>
                     <input class='form-control' name='_method' type='hidden' value='DELETE'> </form> </a>
                     <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                     </td>    
                     <td> <form method='POST' action='http://localhost/computer_service/public/activate_task' 
                        accept-charset='UTF-8' class='form-horizontal'> 
                        <input class='form-control' name='id' type='hidden' value='$task->id'>
                        <input class='form-control' name='_method' type='hidden' value='PATCH'>
                         <input class='btn btn-primary' type='submit' value='Aktywuj'> </form> </a>
                         <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                         </td>  
                 </tr>");
        }
        return $content;
    }

    public function getSearchingResultsSupervisor($tasks)
    {
        $content = "";
        foreach ($tasks as $task) {
            $supervisor=$task->supervisor->name;
            $employee=$task->employee->name;
            $order=$task->order->id;
            $employee=$task->employee->name;
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public/order/$order'>$order</a></td>
            <td>$task->title</td>
            <td>$supervisor</td>
            <td>$employee</td>
            <td>$task->message</td>
            <td>$task->created_at</td>
            <td>$task->updated_at</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/show_task_details/$task->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$task->id'>
                 <input class='btn btn-primary' type='submit' value='Szczegóły'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_task/$task->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$task->id'>
                 <input class='btn btn-primary' type='submit' value='Edytuj'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td> 
            
                 </tr>");
        }
        return $content;
    }

    public function getSearchingResultsEmployee($tasks)
    {
        $content = "";
        foreach ($tasks as $task) {
            $supervisor=$task->supervisor->name;
            $employee=$task->employee->name;
            $order=$task->order->id;
            $employee=$task->employee->name;
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public/order/$order'>$order</a></td>
            <td>$task->title</td>
            <td>$supervisor</td>
            <td>$employee</td>
            <td>$task->message</td>
            <td>$task->created_at</td>
            <td>$task->updated_at</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/show_task_details/$task->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$task->id'>
                 <input class='btn btn-primary' type='submit' value='Szczegóły'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td>
                 </tr>");
        }
        return $content;
    }

    public function refreshTaskMessages(Request $request)
    {

        $tasks = TaskMessage::with('employee')->where('task_id', '=', $request->task_id)->orderBy('updated_at', 'desc')->get();

        $content = "";

        foreach ($tasks as $task) {
            $src = "http://localhost/computer_service/public/css/img/avatars\\";
            $src = $src . $task->employee_id;
            $src = $src . '.jpg';

            $user_name = $task->employee->name;
            $content .=
                ("<div class='div-comments text-left'>
        <blockquote class='mycode_quote'>
            <cite>
                <span> ($task->updated_at)</span>
                <a href='/user/$task->employee_id' class='quick_jump'>
                    <img class='small-img' src='$src'></a>$user_name wrote: $task->message </cite>
        </blockquote>


    </div>");
        }

        return json_encode($content);
    }

}
