<?php

namespace App\Http\Controllers;

use App\Invoice;
use Auth;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InvoiceController extends Controller
{
    public function showInvoiceForm($id)
    {
        $order = Order::with('order_service.service', 'order_part.part', 'order_object', 'customer', 'employee')->where('id', '=', $id)->get()->first();
        $employee = $order->employee->pluck('name', 'id');
        $customer = $order->customer->pluck('name', 'id');
     
        if ($order->status=="closed")
        return view("user.access_denied");
        return view('invoices.create_invoice')->with('order', $order)->with('employee', $employee)->with('customer', $customer);
    }
    public function __construct()
    {
        $this->middleware('auth',['except' => ['showInvoicesList','storeInvoice','generateInvoice','showHTMLInvoiceForm','saveHTMLInvoicesInServer']]);
    }
    public function storeInvoice(Request $request)
    {
        $invoice = [
            'order_id' => $request->order_id,
            'employee_id' => $request->employee_id,
            'payment_method' => $request->payment_method,
            'tax' => $request->tax,
        ];

        $total_part_price = 0;
        $order = Order::with('order_service.service', 'order_part.part', 'order_object', 'customer', 'employee')->where('id', '=', $invoice['order_id'])->get()->first();

        foreach ($order->order_part as $part) {
            if ($part->active && $part->part->active) {
                $one_part_tax = ($part->part->price * $invoice['tax']) / 100;
                $price_for_one_part = $part->part->price - $one_part_tax;
                $total_part_price += ($part->count * $price_for_one_part);
            }
        }
        $total_service_price = 0;
        foreach ($order->order_service as $service) {
            if ($service->active && $service->service->active) {
                $one_service_tax = ($service->service->price * $invoice['tax']) / 100;
                $total_service_price += ($service->service->price - $one_service_tax);
            }
        }

        $invoice['total_price'] = round($total_service_price + $total_part_price, 2);
        $invoice['created_at'] = Carbon::now();
        $invoice['updated_at'] = Carbon::now();

        Invoice::insert($invoice);
        return redirect('show_invoices');
    }

    public function showInvoicesList()
    {
        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $invoices = Invoice::with('employee', 'order.customer')->get();
                return view('invoices.invoices_list_e')->with('invoices', $invoices);          
            }

            case "supervisor":
            {
                $invoices = Invoice::with('employee', 'order.customer')->get();
                return view('invoices.invoices_list')->with('invoices', $invoices);        
            }

            case "admin":
            {
                $invoices = Invoice::with('employee', 'order.customer')->get();
                return view('invoices.invoices_list')->with('invoices', $invoices);            
            }

            default:
            {
              return view('user.access_denied');
                 
            }

        }


    }

    public function generateInvoice(Request $request)
    {
        $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $request->invoice_id)->get()->first();

        return view('invoices.generated_invoice')->with('invoice', $invoice);
    }

    public function showHTMLInvoiceForm($invoice_id)
    {
        return view('invoices.send_invoices')->with('invoice_id', $invoice_id);
    }

    public function saveHTMLInvoicesInServer(Request $request)
    {
        $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $request->invoice_id)->get()->first();
        $files = Input::file('file');
        
        if(count($files)!=2 || @file_get_contents('C:\Invoices\Invoice nr_ ' . $invoice->id . ' ' . $invoice->order->customer->name . '.html')===false)
        return view('user.document_error');
    
       
        foreach ($files as $file) {
            $file_type = explode('.', $file->getClientOriginalName());
            if ($file_type[1] == "html") {
                $html_name = $file_type[0];
            }

        }
        foreach ($files as $file) {
            $file_type = explode('.', $file->getClientOriginalName());
            switch ($file_type[1]) {
                case "html":
                    {

                        $name = $file->getClientOriginalName();
                        $file->move('C:\xampp\htdocs\computer_service\public\invoices\\', $name);
                        break;
                    }

                case "png":
                    {

                        $name = $file->getClientOriginalName();
                        $file->move('C:\xampp\htdocs\computer_service\public\invoices\\' . $html_name . '_files', $name);
                        break;

                    }
                case "css":
                    {

                        $name = $file->getClientOriginalName();
                        $file->move('C:\xampp\htdocs\computer_service\public\invoices\\' . $html_name . '_files', $name);
                        break;
                    }
            }
        }
        $path = 'C:\xampp\htdocs\computer_service\public\invoices\\' . $name;
        $this->generateInvoiceToPDF2($path, $request->invoice_id);
    }
    public function generateInvoiceToPDF2($name, $invoice_id)
    {
        $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $invoice_id)->get()->first();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML(file_get_contents('C:\Invoices\Invoice nr_ ' . $invoice_id . ' ' . $invoice->order->customer->name . '.html'));
        $mpdf->Output('Invoice nr: ' . $invoice_id . ' ' . $invoice->order->customer->name . '.pdf', 'D');
    }
    public function generateInvoiceToPDF(Request $request)
    {

        // Require composer autoload
        $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $request->invoice_id)->get()->first();
// Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDisplayMode('fullpage');
// Write some HTML code:

        $mpdf->WriteHTML(file_get_contents('C:\Invoices\Invoice nr_ ' . $request->invoice_id . ' ' . $invoice->order->customer->name . '.html'));

// Output a PDF file directly to the browser
        $mpdf->Output('Invoice nr: ' . $request->invoice_id . ' ' . $invoice->order->customer->name . 'pdf', 'D');
    }

}
