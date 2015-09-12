<?php


namespace BuyMe\Entities;

class Vendedor extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'vendedor';
	protected 	$primaryKey 	= 'idVendedor';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';


	 public function usuario(){

    	return $this->belongsTo('BuyMe\Entities\Cliente','Usuario');
    }

    public function suscripciones(){

        return $this->hasMany('BuyMe\Entities\Suscripciones', 'Vendedor');
    }

    public function ofertas(){

        return $this->hasMany('BuyMe\Entities\Ofertas', 'Vendedor');
    }

    public function reputacion(){

       return $this->hasMany('BuyMe\Entities\ReputacionV','Vendedor');
    }

    public function keywords(){

       return $this->hasMany('BuyMe\Entities\Keyword','Vendedor');
    }





    
}
