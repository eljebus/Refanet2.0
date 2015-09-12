<?php


namespace BuyMe\Entities;

class Compra extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected 	$table 			= 'compra';
	protected 	$primaryKey 	= 'idCompra';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';




    public function publicacion(){

    	return $this->belongsTo('BuyMe\Entities\Publicacion','Publicacion');
    }

    public function compras(){

    	return $this->belongsTo('BuyMe\Entities\Compra','Compra');
    }

    public function oferta(){

    	return $this->belongsTo('BuyMe\Entities\Ofertas','Oferta');
    }


    public function getOfferBuy(){

    	return $this->oferta()->first();
    }


   

    
}
