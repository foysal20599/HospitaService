<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function storeData(Request $request)
    {
        // return $request->all();
       $data = $request->validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required|max:20',
            'subject' =>'required',
            'message' =>'required'
        ],[
            'name.required' => 'Pleace input your name',
            'email.required' => 'Pleace input your email',
            'phone.required' => 'Pleace input your phone',
            'subject.required' => 'Pleace input your subject',
            'message.required' => 'Pleace input your message'
        ]);
        Contact::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'subject' =>$request->subject,
            'message' =>$request->message,
        ]);
           Mail::send('emails/ContactMail', $data, function($message) use ($data) {
                $message->to('admin@admin.com')->subject('User Info');
                $message->from($data['email']);
            });

            return redirect()->back()->with('success', true);
    }
}



