<?php

namespace App\Http\Middleware;

use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\SuscripcionesRepo;

use Closure;

class LoginAdmin{
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
        if(!\Session::has('UserAdmin')){
          
            return redirect()->guest('/');

        }
      

        return $next($request);
    }
}

