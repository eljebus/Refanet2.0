<?php namespace BuyMe\Entities;

class ReputacionU extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'reputacion_usuario';
	protected 	$primaryKey 	= 'id';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';



  
  

}
