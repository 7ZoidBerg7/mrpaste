<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Msgs;

class SrchController extends Controller
{
    public function Post_Srch(Request $request)
    {
        //dd($request->input('Result'));
        $find_it = $request->input('Result');
        //dd($find_it);
        //$res = \App\Msgs::where('title', 'LIKE', $request->input('Result'))->latest('created_at')->get();
        //dd($res);
        //return view('messages.message',['message'=>$res]);
        return redirect()->route('GetSearch', $find_it);
    }
    
    public function Get_Srch($find_it)
    {
        $res = \App\Msgs::where('title', 'LIKE', '%'.$find_it.'%')
                ->orwhere('text', 'LIKE', '%'.$find_it.'%')->get();
        
        $ms = MsgController::get_posts();
        
        return view('messages.SearchResults',['messages'=>$ms],['your_messages'=>$res]);
    }
}
