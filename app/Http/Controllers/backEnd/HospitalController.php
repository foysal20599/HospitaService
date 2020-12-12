<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(){
        return view('backEnd.page.hospital');
    }
    public function storeData(Request $request){
        // return $request->all();
       $data = $request->validate([
            'name' =>'required',
            'email' =>['required', 'string', 'email', 'max:100', 'unique:hospitals'],
            'phone_1' =>'required|string|unique:hospitals,phone_1|max:20',
            'phone_2' =>'required|string|unique:hospitals,phone_2|max:20',
            'hotline' =>'required|string|unique:hospitals,hotline|max:20',
            'address' =>'required|string',
            'branch_name' =>'required|string|max:191',
            'license_number' =>'required|string|max:191',
            'image' =>'required|image|mimes:jpg,png,jpeg',
            'description' =>'required|string'
        ]);

        if($request->file('image')){
            $path = $request->file('image')->store('Hospital');
        }
        Hospital::insert($data);
        // Hospital::insert([
        //     'name' =>$request->name,
        //     'email' =>$request->email,
        //     'phone_1' =>$request->phone_1,
        //     'phone_2' =>$request->phone_2,
        //     'hotline' => $request->hotline,
        //     'address' => $request->address,
        //     'branch_name' => $request->branch_name,
        //     'license_number' => $request->license_number,
        //     'description' => $request->address,
        //     'image' => $path
        // ]);
        return redirect()->back()->with('success', true);
    }
}
