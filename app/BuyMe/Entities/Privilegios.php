<?php


namespace BuyMe\Entities;

class Cliente extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'privilegios';
	protected 	$primaryKey 	= 'idPrivilegios';
	public 		$timestamps 	= false;
    protected   $connection     = 'contract';



    
}
