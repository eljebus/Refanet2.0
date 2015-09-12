<?php

namespace App\Http\Middleware;

use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\SuscripcionesRepo;

use Closure;

class LoginSeller{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $suscripciones;





    public function handle($request, Closure $next){

        //dd(1);
        if(!\Session::has('User') or !\Session::has('Seller')){
          
            return redirect()->guest('/');

        }
      

        return $next($request);
    }
}

