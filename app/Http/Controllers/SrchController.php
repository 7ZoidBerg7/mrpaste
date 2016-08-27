<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Msgs;

class SrchController extends Controller
{
    public function Post_Srch(Request $request)
    {
        $find_it = $request->input('Result');
        return redirect()->route('GetSearch', $find_it);
    }
    
    public function Get_Srch($find_it)
    {
        $res_title = \App\Msgs::where('access_status', '=', '1')->
        where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->where('title', 'LIKE', '%'.$find_it.'%')->get();
        
        $res_text = \App\Msgs::where('access_status', '=', '1')->
        where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->where('text', 'LIKE', '%'.$find_it.'%')->get();
        
        $ms = MsgController::get_posts();
        
        if (Auth::check())
        {
            $id = auth::id();
            $ys = YourMsgsController::Get_Your_Posts($id);
        }
            else
            {
                $ys = null;
            }
        
        return view('messages.SearchResults',['messages'=>$ms],['srch_title_results'=>$res_title])
                ->with('your_messages',$ys)
                ->with('srch_text_results',$res_text);
    }
}
