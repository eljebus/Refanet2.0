<?php


namespace BuyMe\Entities;

class Cliente extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'usuario';
	protected 	$primaryKey 	= 'id';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';



    public function publicaciones(){

    	return $this->hasMany('BuyMe\Entities\Publicacion','Usuario');
    }

    public function notas(){

    	return $this->hasMany('BuyMe\Entities\Notas','Usuario');
    }

     public function ticket(){

       return $this->hasMany('BuyMe\Entities\Ticket','Usuario');
    }

    public function vendedor(){

       return $this->hasOne('BuyMe\Entities\Vendedor','Usuario');
    }

    public function reputacion(){

       return $this->hasOne('BuyMe\Entities\ReputacionU','Usuario');
    }

 



    
}
