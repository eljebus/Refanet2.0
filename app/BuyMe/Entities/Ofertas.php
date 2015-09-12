<?php


namespace BuyMe\Entities;

class Ofertas extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'oferta';
	protected 	$primaryKey 	= 'idOferta';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';




    public function publicacion(){

    	return $this->belongsTo('BuyMe\Entities\Publicacion','Publicacion');
    }

    public function comentarios(){

    	return $this->hasMany('BuyMe\Entities\Comentarios','Oferta');
    }
    


    public function compra(){

        return $this->hasOne('BuyMe\Entities\Compra','Oferta');
    }


    public function refaccion()
    {
        return $this->hasMany('BuyMe\Entities\Refaccion', 'idRefaccion', 'Refaccion');
    }

    public function vendedor(){

    	return $this->belongsTo('BuyMe\Entities\Vendedor','Vendedor');
    }

    public function aceptOffer(){

        return $this->where('Estado','=','B')
                    ->orWhere('Estado','=','C');
    }

    public function getPublish(){

        return $this->publicacion()->first();
    }


  

    
}
