<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index(){
        return view('frontEnd.index');
    }
    public function about(){
        return view('frontEnd.page.aboutUs');
    }
    public function contact(){
        return view('frontEnd.page.contactUs');
    }
    public function doctorService(){
        return view('frontEnd.page.findDoctor');
    }
    public function hospitalService(){
        return view('frontEnd.page.findHospital');
    }
    public function profile(){
        return view('frontEnd.page.profile');
    }
}
