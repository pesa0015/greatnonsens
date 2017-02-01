<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Input;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lang;

// class LoginController extends Controller
// {
// 	public function logout()
// 	{
// 		Auth::logout();
// 		return redirect('/');
// 	}

// 	public function showLogin()
// 	{
// 		return view('auth.login');
// 	}

// 	public function login()
// 	{
// 		$username = Input::get('username');
// 		$user = User::where('username', $username)->orWhere('email', $username)->first();
// 		if(!$user) {
// 			return redirect('login')->withErrors(['email' => Lang::get('auth.username')])->withInput(); 
// 		}
// 		// create our user data for the authentication
// 		$userdata = array(
// 		    'username'     => $user->username,
// 		    'password'  => Input::get('password')
// 		);
// 		if (Auth::attempt($userdata)) {
// 			return redirect('/');
// 		}
// 		return redirect('login')->withErrors(['password' => Lang::get('auth.password')])->withInput();
// 	}
// }