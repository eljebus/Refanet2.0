<?php namespace App\Http\Middleware;

use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\SuscripcionesRepo;
use BuyMe\Repos\ContratoRepo;
use BuyMe\Repos\ClienteRepo;

use Closure;

class MarcaSeller{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $suscripciones;

    protected $contrato;
    protected $cliente;


    public function __construct(SuscripcionesRepo   $suscriptions,
                                ContratoRepo        $contract,
                                ClienteRepo         $client){

      
        $this->suscripciones= $suscriptions;

        $this->cliente      = $client;    

        $this->contrato     = $contract;

    }


    public function handle($request, Closure $next){

        $seller =  \Session::get('Seller');



        $seller = $this->cliente->getBySeller($seller);


        if(is_null($seller)){

            return redirect()->guest('/Vendedor/perfil');            
        }

        elseif(is_null($this->contrato->getBySeller($seller->idClientes))){

          
            return redirect()->guest('/Vendedor/perfil');
        }

        elseif($this->contrato->getByDate($seller->idClientes))
                return redirect()->guest('/Vendedor/perfil');

        
      
        return $next($request);
    }
}

