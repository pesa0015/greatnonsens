<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Auth;

class SaveUserIfGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);

        if (!Auth::check() && !Cookie::get('guest')) {
            $guest = new \App\Repositories\UserRepo();
            $user = $guest->create([
                    'username' => 'Guest',
                    'is_guest' => 1
                ]);
            Auth::attempt(['email' => $user->email, 'password' => $user->email]);
            $minutes = 2628000; // Five years
            return $response
                ->withCookie(cookie()->forever('guest', $user))
                ->withCookie(cookie()->forever('cookie_information', true));
        }
        return $response;
    }
}
