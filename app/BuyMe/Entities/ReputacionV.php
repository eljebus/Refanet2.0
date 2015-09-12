<?php


namespace BuyMe\Entities;

class ReputacionV extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'reputacion_vendedor';
	protected 	$primaryKey 	= 'id';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';



  
 

}
