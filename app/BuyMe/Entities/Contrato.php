<?php


namespace BuyMe\Entities;

class Contrato extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'contrato';
	protected 	$primaryKey 	= 'idContrato';
	public 		$timestamps 	= false;
    protected   $connection     = 'contract';



    
}
