<?php


namespace BuyMe\Entities;

class Galeria extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'galeria';
	protected 	$primaryKey 	= 'idGaleria';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';



    public function refaccion()
    {
      return $this->belongsTo('BuyMe\Entities\Refaccion','idRefaccion');
    }

}
