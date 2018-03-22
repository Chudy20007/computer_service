<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\OrderObject;
use App\Task;
use App\TaskMessage;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions', ['except' => ['storeTaskMessage', 'refreshTaskMessages', 'showTasksList', 'showTaskDetails']]);
    }

    public function showTaskForm($id = null)
    {
        $employees = User::where('role', '=', 'employee')->pluck('name', 'id');
        $orders = OrderObject::with('order')->get()->where('order.status', '=', 'active')->pluck('name', 'order_id');

        return view('tasks.create_task')->with('orders', $orders)->with('employees', $employees)->with('id', $id);
    }

    public function showTaskEditForm($id)
    {
        $employees = User::where('role', '=', 'employee')->pluck('name', 'id');
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
        return redirect("show_tasks");
    }

    public function storeTask(TaskRequest $request)
    {

        $request->request->add(['supervisor_id' => Auth::id()]);
        $task = Task::create($request->toArray());
        return ("Success!");
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
                    return redirect('pictures.access_denied');

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
