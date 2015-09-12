<?php


namespace BuyMe\Entities;

class Suscripciones extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'suscripciones';
	protected 	$primaryKey 	= array('Vendedor', 'Marca', 'Categoria');
	public 		$timestamps 	= false;
	public      $incrementing 	= false;
	protected   $connection     = 'mysql';


	public function vendedor(){

    	return $this->belongsTo('BuyMe\Entities\Vendedor','Vendedor');
    }

    public function categoria(){

    	return $this->belongsTo('BuyMe\Entities\Categoria','Categoria');
    }

    public function marca(){

    	return $this->belongsTo('BuyMe\Entities\Marca','Marca');
    }


    
}
