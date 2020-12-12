<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistationController extends Controller
{
    public function index(){
        return view('frontEnd.page.registation');
    }
    public function storeData(Request $request){
    //   return $request->all();
       $data = $request->validate([
            'name' =>'required',
            'phone' =>'required|unique:users',
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'address' =>'required',
            'password' => ['required', 'min:6', 'confirmed'],
        ],[
            'name.required' => 'please input your name',
            'phone.required' => 'please input your phone',
            'email.required' => 'please valid email',
            'address.required' => 'please input your address',
            'password.required' => 'please input your password'
        ]);

        try{
            User::insert([
                'name' =>$request->name,
                'phone' =>$request->phone,
                'email' =>$request->email,
                'address' =>$request->address,
                'password' => Hash::make($request->password),
                'type' => 3,
            ]);
        }catch(\Exception $e){

            report($e);
            dd($e->getMessage());

        }

        // return $request->all();
        Mail::send('emails/registationMail', $data, function($message) use ($data) {
            $message->to('admin@admin.com')->subject('User Info');
            $message->from($data['email']);
        });

        return redirect()->back()->with('success', true);
    }
}
