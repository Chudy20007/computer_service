<?php

namespace App\Http\Controllers;
use App\Complaint;
use App\Order;
use Carbon\Carbon;
use App\Invoice;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['showComplaintsList','storeComplaint','generateComplaint','showHTMLComplaintForm','saveHTMLComplaintsInServer']]);
    }

    public function showComplaintForm($id)
    {
        $invoice = Invoice::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', '=', $id)->get()->first();
        
       
        $employee = $invoice->employee->pluck('name', 'id');
        $customer = $invoice->order->customer->pluck('name', 'id');

        return view('complaints.create_complaint')->with('invoice', $invoice)->with('employee', $employee)->with('customer', $customer);
    }
    


    public function storeComplaint(Request $request)
    {
        $complaint = [
            'employee_id' => $request->employee_id,
            'payment_method' => $request->payment_method,
            'tax' => $request->tax,
            'invoice_id' => $request->invoice_id
        ];

        $total_part_price = 0;
        $order = Order::with('order_service.service', 'order_part.part', 'order_object', 'customer', 'employee')->where('id', '=', $request->order_id)->get()->first();

        foreach ($order->order_part as $part) {
            if ($part->active && $part->part->active) {
                $one_part_tax = ($part->part->price * $complaint['tax']) / 100;
                $price_for_one_part = $part->part->price - $one_part_tax;
                $total_part_price += ($part->count * $price_for_one_part);
            }
        }
        $total_service_price = 0;
        foreach ($order->order_service as $service) {
            if ($service->active && $service->service->active) {
                $one_service_tax = ($service->service->price * $complaint['tax']) / 100;
                $total_service_price += ($service->service->price - $one_service_tax);
            }
        }

        $complaint['total_price'] = round($total_service_price + $total_part_price, 2);
        $complaint['created_at'] = Carbon::now();
        $complaint['updated_at'] = Carbon::now();

        Complaint::insert($complaint);
        return redirect('show_complaints');
    }

    public function showComplaintsList()
    {
        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $complaints = Complaint::with('employee', 'invoice.order.customer')->get();
               
                return view('complaints.complaints_list_e')->with('complaints', $complaints);          
            }

            case "supervisor":
            {
                $complaints = Complaint::with('employee', 'order.customer')->get();
                return view('complaints.complaints_list')->with('complaints', $complaints);        
            }

            case "admin":
            {
                $complaints = Complaint::with('employee', 'order.customer')->get();
                return view('complaints.complaints_list')->with('complaints', $complaints);            
            }

            default:
            {
              return view('user.access_denied');
                 
            }

        }


    }

    public function generateComplaint(Request $request)
    {
      
        $complaint = Complaint::with('invoice.order.order_service.service', 'invoice.order.order_part.part', 'invoice.order.order_object', 'invoice.order.customer', 'employee')
        ->where('id', $request->complaint_id)->get()->first();
        return view('complaints.generated_complaint')->with('complaint', $complaint);
    }

    public function showHTMLComplaintForm($invoice_id)
    {
        return view('complaints.send_complaints')->with('complaint_id', $invoice_id);
    }

    public function saveHTMLComplaintsInServer(Request $request)
    {
        $files = Input::file('file');
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
                        $file->move('C:\xampp\htdocs\computer_service\public\complaints\\', $name);
                        break;
                    }

                case "png":
                    {

                        $name = $file->getClientOriginalName();
                        $file->move('C:\xampp\htdocs\computer_service\public\complaints\\' . $html_name . '_files', $name);
                        break;

                    }
                case "css":
                    {

                        $name = $file->getClientOriginalName();
                        $file->move('C:\xampp\htdocs\computer_service\public\complaints\\' . $html_name . '_files', $name);
                        break;
                    }
            }
        }
        $path = 'C:\xampp\htdocs\computer_service\public\complaints\\' . $name;
        $this->generateComplaintToPDF2($path, $request->complaint_id);
    }
    public function generateComplaintToPDF2($name, $complaint_id)
    {
       
        $invoice = Complaint::with('order_service.service', 'order_part.part', 'order_object', 'invoice.order.customer', 'employee')->where('id', $complaint_id)->get()->first();
       
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML(file_get_contents('C:\Complaints\Complaint nr_ ' . $complaint_id . ' ' . $invoice->invoice->order->customer->name . '.html'));
        $mpdf->Output('Complaint nr: ' . $complaint_id . ' ' . $invoice->invoice->order->customer->name . '.pdf', 'D');
    }
    public function generateComplaintToPDF(Request $request)
    {

        // Require composer autoload
        $invoice = Complaint::with('order_service.service', 'order_part.part', 'order_object', 'order.customer', 'employee')->where('id', $request->invoice_id)->get()->first();
// Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDisplayMode('fullpage');
// Write some HTML code:

        $mpdf->WriteHTML(file_get_contents('C:\Complaints\Complaint nr_ ' . $request->invoice_id . ' ' . $invoice->order->customer->name . '.html'));

// Output a PDF file directly to the browser
        $mpdf->Output('Complaint nr: ' . $request->invoice_id . ' ' . $invoice->order->customer->name . 'pdf', 'D');
    }

}


