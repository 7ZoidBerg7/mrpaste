<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class YourMsgsController extends Controller
{
    public static function Get_Your_Posts($id)
    {
        $ys = \App\Msgs::where(['user_id'=>$id])->where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->latest('created_at')->get();
            
            return ($ys);
    }


    public function show()
    {
        $id = Auth::id();
        $ys = YourMsgsController::Get_Your_Posts($id);
        $ms = MsgController::get_posts();

        return view('messages.YourMessages',['messages'=>$ms],['your_messages'=>$ys]);
    }
    

}
