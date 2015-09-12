<?php


namespace BuyMe\Entities;

class ClienteC extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'cliente';
	protected 	$primaryKey 	= 'idClientes';
	public 		$timestamps 	= false;
    protected   $connection     = 'contract';

    public function __toString() {
    	
	    if(is_null($this->users_class)) {
	        return 'NULL';
	    }
	    return $this->user_class;
	}


	public function contrato(){

        return $this->hasOne('BuyMe\Entities\Contrato','Clientes');
    }


    
}
