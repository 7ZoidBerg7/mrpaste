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
        $res = \App\Msgs::where('title', 'LIKE', '%'.$find_it.'%')
                ->orwhere('text', 'LIKE', '%'.$find_it.'%')->get();
        
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
        
        return view('messages.SearchResults',['messages'=>$ms],['srch_results'=>$res])->with('your_messages',$ys);
    }
}
