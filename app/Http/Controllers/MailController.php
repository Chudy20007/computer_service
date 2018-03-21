<?php

namespace App\Http\Controllers;
use Swift_Attachment;
use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
    public function sendMessage(Request $request)
    {
        $datas = $request->all();
        $email = User::where('id', $datas['user_id'])->get(['email']);

        $datas['email'] = $email[0]->email;
        $em['email'] = $datas['email'];
        $em['content'] = $datas['message'];
        $em['path'] = $swiftAttachment = Swift_Attachment::fromPath("C:/Users/Krystian/Desktop/a.pdf");

        Mail::send('mail', ['title' => "Order status1 updated"], function ($m) use ($em) {

            $m->to($em['email'])
                ->from('computer_service@gmail.com', 'Computer Service')
                ->subject('Order status updated')
                ->setBody($em['content'], 'text/html');
            //  ->attach($em['path'], array('as' => 'invoice.pdf', 'mime' => 'LONGTEXT'));
            return "Send";
        });
    }
}
