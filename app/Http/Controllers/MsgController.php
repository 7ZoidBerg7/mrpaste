<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Msgs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MsgController extends Controller
{
    public function save(Request $request)
    {
        $all=$request->all();
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;  
        while (strlen($code) < 6) {
                $code .= $chars[mt_rand(0,$clen)];  
        }
        
        $all['slug'] = $code;
        $slug = $code;
        //$all['user_id'] = Auth::user()->id;
        \App\Msgs::create($all);
        
        return redirect()->route('message',$slug);
        
    }
    
    public function show($slug)
    {
        $ms = \App\Msgs::where(['slug'=>$slug])->get();        
        return view('messages.message',['message'=>$ms]);
    }
    
    public function destroy($slug)
    {
        //dd($slug);
        $msg = \App\Msgs::where('slug', '=', $slug);
        //dd($msg);
        $msg -> delete();
        return back()->with('message','Запись удалена');
    }
    
    public function change($slug)
    {
        $msg = \App\Msgs::where('slug', '=', $slug)->get();
        return view('messages.ChangeMessage', ['messages' => $msg]);
    }


    public function changed(Request $request, $slug)
    {
        $msg = \App\Msgs::where('slug', '=', $slug)->first();
        $msg -> title = $request['title'];
        $msg -> text = $request['text'];
        $msg -> save();
        return redirect()->route('YourMsgs');
    }
    
    public function SecretZone()
    {
        dd(auth::user());
        if ((auth::User_Role) == 1){
            echo 'vse ok';
        }
    }
}
