<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('backEnd.page.doctor');
    }
    public function storeData(Request $request){
        // return $request->all();
        $data = $request->validate([
            'name' =>'required',
            'email' =>['required', 'string', 'email', 'max:100', 'unique:hospitals'],
            'phone_1' =>'required|string|unique:hospitals,phone_1|max:20',
            'phone_2' =>'required|string|unique:hospitals,phone_2|max:20',
            'education_history_1' =>'required|string|max:120',
            'education_history_2' =>'required|string|max:120',
            'destination_1' =>'required|string',
            'destination_2' =>'required|string',
            'profession_1' =>'required|string|max:191',
            'profession_2' =>'required|string|max:191',
            'address' =>'required|string|max:191',
            'image' =>'required|image|mimes:jpg,png,jpeg',
            'description' =>'required|string'
        ]);
        // return $request->all();

        if($request->file('image')){
            $path = $request->file('image')->store('Doctor');
        }
        Doctor::insert($data);
        // return $request->all();

        return redirect()->back()->with('success', true);
    }
}
