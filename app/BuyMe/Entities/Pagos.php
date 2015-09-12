<?php


namespace BuyMe\Entities;

class Pagos extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'pagos';
	protected 	$primaryKey 	= 'idPagos';
	public 		$timestamps 	= false;
    protected   $connection     = 'contract';



    
}
