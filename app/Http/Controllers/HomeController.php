<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {        
        $messages = \App\Msgs::where('access_status', '=', '1')->latest('created_at')->get();
        return view('index',['messages'=>$messages]);
    }
}
