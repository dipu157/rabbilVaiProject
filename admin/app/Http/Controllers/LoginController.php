<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    function onLogin(Request $req){

    	$user = $req->input('user');
    	$pass = $req->input('pass');

    	$value = User::where('email','=',$user)->where('password','=',$pass)->count();

    	//dd($value);

    	if($value == 1){
    		$req->session()->put('user',$user);
    		return 1;
    	}else{
    		return 0;
    	}
    }

    function onLogOut(Request $request){

        $request->session()->flush();
        return redirect('/');
    }
}
