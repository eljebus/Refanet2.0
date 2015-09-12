<?php

namespace App\Http\Middleware;

use BuyMe\Repos\UsersRepo;
use Closure;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        //dd(1);
        if(!\Session::has('User')){
          
            return redirect()->guest('/');

        }

        return $next($request);
    }
}

