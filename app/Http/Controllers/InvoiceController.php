<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderPart;
use App\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
   public function showInvoiceForm($id)
   {
        $order = Order::with('order_service.service','order_part.part','order_object','customer','employee')->where('id','=',$id)->get()->first();
        $employee = $order->employee->pluck('name','id');
        $customer = $order->customer->pluck('name','id');
       
        return view('invoices.create_invoice')->with('order',$order)->with('employee',$employee)->with('customer',$customer);
   }

   public function storeInvoice(Request $request)
   {
       $invoice =[
        'order_id' => $request->order_id,
        'employee_id' => $request->employee_id,
        'payment_method' => $request->payment_method,
        'tax' => $request->tax
       ];
       
       $total_part_price=0;
       $order = Order::with('order_service.service','order_part.part','order_object','customer','employee')->where('id','=',$invoice['order_id'])->get()->first();
    

       foreach($order->order_part as $part)
       {
        if ($part->active && $part->part->active)
        {
           $one_part_tax=($part->part->price*$invoice['tax'])/100;
           $price_for_one_part = $part->part->price - $one_part_tax;
        $total_part_price+= ($part->count*$price_for_one_part);
       }
    }
       $total_service_price=0;
       foreach($order->order_service as $service)
       {
           if ($service->active && $service->service->active)
           {
        $one_service_tax=($service->service->price*$invoice['tax'])/100;
        $total_service_price+= ($service->service->price-$one_service_tax);
           }
       }
   
       $invoice['total_price']=round($total_service_price+$total_part_price,2);
       $invoice['created_at']=Carbon::now();
       $invoice['updated_at']=Carbon::now();

       Invoice::insert($invoice);
       return redirect ('invoices_list');
   }

   public function showInvoicesList()
   {
       $invoices=Invoice::with('employee','order.customer')->get();
       return view('invoices.invoices_list')->with('invoices',$invoices);
   }

   public function generateInvoice(Request $request)
   {
       $invoice = Invoice::with('order_service.service','order_part.part','order_object','order.customer','employee')->where('id',$request->invoice_id)->get()->first();
       
       return view('invoices.generated_invoice')->with('invoice',$invoice);
   }

   public function generateInvoiceToPDF(Request $request)
   {
       $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $request->invoice_id)->get()->first();
       // Require composer autoload

// Create an instance of the class:
       $mpdf = new \Mpdf\Mpdf();
       $mpdf->SetDisplayMode('fullpage');
// Write some HTML code:

       $mpdf->WriteHTML(file_get_contents('C:\Invoices\Invoice nr_ ' . $request->invoice_id . ' ' . $invoice->order->customer->name.'.html'));

// Output a PDF file directly to the browser
       $mpdf->Output('Invoice nr: ' . $request->invoice_id . ' ' . $invoice->order->customer->name . 'pdf', 'D');
   }

}
