<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invoice;
use App\Order;
use App\OrderObject;
use App\OrderPart;
use App\OrderService;
use App\Part;
use App\Service;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function deactivateOrder(Request $request)
    {
        $id = $request->id;
        Order::where('id', '=', $id)->update([
            'active' => false,
            'status' => 'closed',
        ]);
        Session::put('message', 'Zlecenie zostało pomyślnie zdezaktywowane!');
        return redirect('show_orders');
    }

    public function activateOrder(Request $request)
    {
        $id = $request->id;
        Order::where('id', '=', $id)->update([
            'active' => true,
            'status' => 'active',
        ]);
        Session::put('message', 'Zlecenie zostało pomyślnie aktywowane!');
        return redirect('show_orders');
    }

    public function deactivateCategory(Request $request)
    {
        $id = $request->id;
        Category::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Kategoria została pomyślnie zdezaktywowana!');
        return redirect('show_categories');
    }

    public function activateCategory(Request $request)
    {
        $id = $request->id;
        Category::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Kategoria została pomyślnie aktywowana!');
        return redirect('show_categories');
    }

    public function deactivateService(Request $request)
    {
        $id = $request->id;
        Service::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Usługa została pomyślnie zdezaktywowana!');
        return redirect('show_services');
    }

    public function activateService(Request $request)
    {
        $id = $request->id;
        Service::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Usługa została pomyślnie aktywowana!');
        return redirect('show_services');
    }

    public function deactivateEmployee(Request $request)
    {
        $id = $request->id;
        User::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Pracownik został pomyślnie zdezaktywowany!');
        return redirect('show_employees');
    }

    public function activateEmployee(Request $request)
    {
        $id = $request->id;
        User::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Pracownik został pomyślnie aktywowany!');
        return redirect('show_employees');
    }

    public function deactivatePart(Request $request)
    {
        $id = $request->id;
        Part::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Część została pomyślnie zdezaktywowana!');
        return redirect('show_parts');
    }

    public function activatePart(Request $request)
    {
        $id = $request->id;
        Part::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Część została pomyślnie aktywowana!');
        return redirect('show_parts');
    }

    public function deactivateTask(Request $request)
    {
        $id = $request->id;
        Task::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Wątek został pomyślnie zdezaktywowany!');
        return redirect('show_tasks');
    }

    public function activateTask(Request $request)
    {
        $id = $request->id;
        Task::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Wątek została pomyślnie aktywowany!');
        return redirect('show_tasks');
    }

    public function deactivateOrderService(Request $request)
    {
        $id = $request->service_id;
        OrderService::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Usługa dla zlecenia została pomyślnie zdezaktywowana!');
        return redirect('show_order_services/' . $request->order_id);
    }

    public function activateOrderService(Request $request)
    {
        $id = $request->service_id;
        OrderService::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Usługa dla zlecenia została pomyślnie aktywowana!');
        return redirect('show_order_services/' . $request->order_id);
    }

    public function deactivateOrderPart(Request $request)
    {
        $id = $request->part_id;
        OrderPart::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Część dla została pomyślnie zdezaktywowana!');
        return redirect('show_order_parts/' . $request->order_id);
    }

    public function activateOrderPart(Request $request)
    {
        $id = $request->part_id;
        OrderPart::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Część dla zlecenia została pomyślnie aktywowana!');
        return redirect('show_order_parts/' . $request->order_id);
    }

    public function deactivateOrderObject(Request $request)
    {
        $id = $request->object_id;
        OrderObject::where('id', '=', $id)->update([
            'active' => false,
        ]);
        Session::put('message', 'Przedmiot dla zlecenia został pomyślnie zdezaktywowany!');
        return redirect('show_order_objects/' . $request->order_id);
    }

    public function activateOrderObject(Request $request)
    {
        $id = $request->object_id;
        OrderObject::where('id', '=', $id)->update([
            'active' => true,
        ]);
        Session::put('message', 'Przedmiot dla zlecenia został pomyślnie aktywowany!');
        return redirect('show_order_objects/' . $request->order_id);
    }

    public function deactivateInvoice(Request $request)
    {
        $id = $request->invoice_id;
        Invoice::where('id', '=', $id)->update([
            'active' => false,
        ]);
        return redirect('invoices_list');
    }

    public function activateInvoice(Request $request)
    {
        $id = $request->invoice_id;
        Invoice::where('id', '=', $id)->update([
            'active' => true,
        ]);
        return redirect('invoices_list');
    }

}
