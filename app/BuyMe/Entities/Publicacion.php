<?php


namespace BuyMe\Entities;

class Publicacion extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'publicacion';
	protected 	$primaryKey 	= 'idPublicacion';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';



    public function refaccion()
    {
        return $this->hasMany('BuyMe\Entities\Refaccion', 'idRefaccion', 'Refaccion');
    }

    public function ofertas(){

    	return $this->hasMany('BuyMe\Entities\Ofertas', 'Publicacion');
    }

    public function oferta(){

        return $this->hasMany('BuyMe\Entities\Ofertas', 'idOferta');
    }

    public function usuario(){

    	return $this->belongsTo('BuyMe\Entities\Cliente','Usuario');
    }

    public function compra(){

        return $this->hasMany('BuyMe\Entities\Compra', 'Publicacion', 'idPublicacion');
    }

    public function categoria(){

        return $this->belongsTo('BuyMe\Entities\Categoria','Categoria');
    }

    public function notas(){

        return $this->hasMany('BuyMe\Entities\Notas', 'Publicacion');
    }





  
}
