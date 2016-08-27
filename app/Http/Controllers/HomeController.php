<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {        
        $current_time = date('Y-m-d H:i:s', time());
        $messages = \App\Msgs::where('access_status', '=', '1')->where('updated_at', '=', 'live_to', 'or', 'live_to', '>', $current_time) ->latest('created_at')->get();
        return view('index',['messages'=>$messages]);
    }
}
