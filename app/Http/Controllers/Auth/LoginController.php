<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Lang;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login()
    {
        $username = Input::get('username');
        $user = User::where('username', $username)->orWhere('email', $username)->first();
        if(!$user) {
            return redirect('login')->withErrors(['email' => Lang::get('auth.username')])->withInput(); 
        }
        // create our user data for the authentication
        $userdata = array(
            'username'     => $user->username,
            'password'  => Input::get('password')
        );
        if (Auth::attempt($userdata)) {
            return redirect('/')->with('login-successful', true);
        }
        return redirect('login')->withErrors(['password' => Lang::get('auth.password')])->withInput();
    }
}
