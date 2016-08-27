<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {        
        //$current_time = date('Y-m-d H:i:s', time());
        //$messages = \App\Msgs::where('access_status', '=', '1')->where('live_to', '>', $current_time)->latest('created_at')->get();
        $messages = \App\Msgs::where('access_status', '=', '1')->
        where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->latest('created_at')->get();
        return view('index',['messages'=>$messages]);
    }
}
