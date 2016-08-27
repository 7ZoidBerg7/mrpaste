<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $messages = MsgController::Get_Posts();
        
        if (Auth::check())
        {
            $id = auth::id();
            $ys = YourMsgsController::Get_Your_Posts($id);
        }
            else
            {
                $ys = null;
            }
        
        return view('index',['messages'=>$messages],['your_messages'=>$ys]);
    }
}
