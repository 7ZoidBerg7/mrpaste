<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Mail;
use App\ConfirmUsers;



class AdvReg extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:100',
            'email' => 'required|unique:users|max:250|unique:confirm_users|email',
            'password' => 'required|confirmed|min:6',
        ]);
        
        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if($user)
        {
            $email=$user->email;  
            $token=str_random(32); 
            $model=new ConfirmUsers; 
            $model->email=$email; 
            $model->token=$token; 
            $model->save();      
            
            Mail::send('emails.confirm',['token'=>$token],function($u) use ($user)
            {
                $u->from('admin@test23.ru');
                $u->to($user->email);
                $u->subject('Confirm registration');
            });

            return back()->with('message','<a href="/register/confirm/'.$token.'">Ссылка для подтверждения</a>');
        }
        else {
                 return back()->with('message','Беда с базой, попробуй позже');
             }
        
        
    }
    
    public function confirm($token)
    {
        $model=ConfirmUsers::where('token','=',$token)->firstOrFail();
        $user=User::where('email','=',$model->email)->first();
        $user->status=1;
        $user->save();
        $model->delete();
        return back()->with('message','Всё окей');
    }
    
    public function test()
    {
        
        echo 'sdsdsd';
    }
    
}
