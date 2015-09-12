<?php


namespace BuyMe\Entities;

class Comentarios extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'comentarios';
	protected 	$primaryKey 	= 'idComentarios';
	public 		$timestamps 	= false;
	protected 	$connection 	= 'mysql';


    public function oferta(){

    	return $this->belongsTo('BuyMe\Entities\Ofertas','Oferta');
    }

 	public function usuario(){

    	return $this->belongsTo('BuyMe\Entities\Cliente','Usuario');
    }
    


  
}
