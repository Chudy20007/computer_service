<?php

namespace App\Http\Controllers;
use App\Order;
use App\Part;
use App\Service;
use App\Task;
use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function deactivateOrder(Request $request)
    {
        $id= $request->id;
        Order::where('id', '=', $id)->update([
            'active'=>false,
            'status'=>'closed'
        ]);  

        return redirect('show_orders');
    }

    public function activateOrder(Request $request)
    {
        $id= $request->id;
        Order::where('id', '=', $id)->update([
            'active'=>true,
            'status'=>'active'
        ]);  

        return redirect('show_orders');
       
    }

    public function deactivateCategory(Request $request)
    {
        $id= $request->id;
        Category::where('id', '=', $id)->update([
            'active'=>false
        ]);  

        return redirect('show_categories');
    }

    public function activateCategory(Request $request)
    {
        $id= $request->id;
        Category::where('id', '=', $id)->update([
            'active'=>true
        ]);  

        return redirect('show_categories');
    }

    public function deactivateService(Request $request)
    {
        $id= $request->id;
        Service::where('id', '=', $id)->update([
            'active'=>false
        ]);  

        return redirect('show_services');
    }

    public function activateService(Request $request)
    {
        $id= $request->id;
        Service::where('id', '=', $id)->update([
            'active'=>true
        ]);  

        return redirect('show_services');
    }

    public function deactivateEmployee(Request $request)
    {
        $id= $request->id;
        Employee::where('id', '=', $id)->update([
            'active'=>false
        ]);  
        return redirect('show_employees');
    }

    public function activateEmployee(Request $request)
    {
        $id= $request->id;
        Employee::where('id', '=', $id)->update([
            'active'=>true
        ]);  
        return redirect('show_employees');
    }
    public function deactivatePart(Request $request)
    {
        $id= $request->id;
        Part::where('id', '=', $id)->update([
            'active'=>false
        ]);  
        return redirect('show_parts');
    }

    public function activatePart(Request $request)
    {
        $id= $request->id;
        Part::where('id', '=', $id)->update([
            'active'=>true
        ]);  
        return redirect('show_parts');
    }

    public function deactivateTask(Request $request)
    {
        $id= $request->id;
        Task::where('id', '=', $id)->update([
            'active'=>false
        ]);  
        return redirect('show_tasks');
    }

    public function activateTask(Request $request)
    {
        $id= $request->id;
        Task::where('id', '=', $id)->update([
            'active'=>true
        ]);  
        return redirect('show_tasks');
    }


}
