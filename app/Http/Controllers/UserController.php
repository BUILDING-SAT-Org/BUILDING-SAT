<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function register_user(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if ($user != null) {
            // return redirect('signin', 302);
        } else {

            // $admin_user = User::where('id', $request['user_id'])->first();

            $user = new User();
            $user->name = $request['user_name'];
            $user->user_type = 1; //$request['user_type'];
            $user->email = $request['email'];
            $user->company = "";//$request['email'];
            $user->country = "";//$request['country'];
            $user->city = "";//$request['city'];
            $user->number = "";//$request['number'];
            $user->newsletter = 0;//$request['newsletter'];
            $user->role = 0;//$request['role'];
            $user->password = $request['password'];

            $user->save();
        }

        return redirect('signin', 302);;
    }

    public function login_user(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if($user == null){
            return redirect('signin', 302)->with('password_incorrect',true);
        }
        else{
                if ($user->password == $request['password']) {
                    $request->session()->put('user_id', $user->id);
                    $request->session()->put('user_name', $user->name);
                    return redirect('dashboard', 302);
                }else{
                    return redirect('signin', 302)->with('password_incorrect',true);
                }
            
        }
    }

    public function logout_user(Request $request)
    {
        Session::flush();
        return redirect('/signin');
    }
}
