<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Msgs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MsgController extends Controller
{
    public static function Get_Posts()
    {
        $ms = \App\Msgs::where('access_status', '=', '1')->
        where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->latest('created_at')->get();
            
    return($ms);
    }


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
        
        if ($all['add_time'] <> 0)
            {
                $live_time = time() + $all['add_time'];
                $all['live_to'] = date('Y-m-d H:i:s', $live_time);
                //dd($all);
            }
            else
                {
                    $all['non_delete'] = 1;
                }
        
        \App\Msgs::create($all);
        
        return redirect()->route('message',$slug);
        
    }
    
    public function show($slug)
    {
        $ms = \App\Msgs::
        where(function ($query) {
            $current_time = date('Y-m-d H:i:s', time());    
            $query->where('live_to', '>', $current_time)
                  ->orwhere('non_delete', '=', 1);
            })->where(['slug'=>$slug])->get();
        return view('messages.message',['message'=>$ms]);
    }
    
    public function destroy($slug)
    {
        $msg = null;
        if (auth::check())
        {
            $msg = \App\Msgs::where('slug', '=', $slug)->where('user_id', '=', auth::id());
            if ($msg != null)
            {
                $msg -> delete();
                return back()->with('message','Запись удалена');
            }
            
        }
    return back()->with('message','Невозможно удалить запись');
    }
    
    public function change($slug)
    {
        //$msg = \App\Msgs::where('slug', '=', $slug)->get();
        //return view('messages.ChangeMessage', ['messages' => $msg]);
        $msg = null;
        if (auth::check())
        {
            $messages = MsgController::Get_Posts();
            $id = auth::id();
            $ys = YourMsgsController::Get_Your_Posts($id);
            $msg = \App\Msgs::where('slug', '=', $slug)->where('user_id', '=', auth::id());
            if ($msg != null)
            {
                $msg = \App\Msgs::where('slug', '=', $slug)->first();
                return view('messages.ChangeMessage',['change_messages'=>$msg],['your_messages'=>$ys])->with('messages',$messages);
                //return view('messages.ChangeMessage', ['messages' => $msg]);
            }
            
        }
    return back()->with('message','Вы не можете изменить эту запись');        
    }


    public function changed(Request $request, $slug)
    {
        $msg = \App\Msgs::where('slug', '=', $slug)->first();
        $msg -> title = $request['title'];
        $msg -> text = $request['text'];
        $msg -> access_status = $request['access_status'];
        if ($request['add_time'] <> 0)
            {
                $live_time = time() + $request['add_time'];
                $msg['live_to'] = date('Y-m-d H:i:s', $live_time);
                $msg['non_delete'] = 0;
                //dd($all);
            }
            else
                {
                    $msg['non_delete'] = 1;
                }
        $msg -> save();
        return redirect()->route('YourMsgs');
    }
    
}
