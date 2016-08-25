<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class YourMsgsController extends Controller
{
    public function show()
    {
        $id = Auth::id();
        $ys = \App\Msgs::where(['user_id'=>$id])->latest('created_at')->get();
        //$ms = \App\Msgs::latest('created_at')->get();
        $ms = \App\Msgs::where('access_status', '=', '1')->latest('created_at')->get();
        return view('messages.YourMessages',['messages'=>$ms],['your_messages'=>$ys]);
    }
    

}
