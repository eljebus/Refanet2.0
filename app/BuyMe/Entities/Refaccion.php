<?php


namespace BuyMe\Entities;

class Refaccion extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'refaccion';
	protected 	$primaryKey 	= 'idRefaccion';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';



  
    public function usuarios()
    {
       return $this->belongsToMany('BuyMe\Entities\Cliente', 'categoria_usuario', 'Usario', 'Categoria');
    }

    public function galeria(){

    	return $this->hasMany('BuyMe\Entities\Galeria','Refaccion');
    }



    public function marca(){

        return $this->belongsTo('BuyMe\Entities\Marca','Marca');
    }

    public function publicacion(){

        return $this->belongsTo('BuyMe\Entities\Publicacion','idRefaccion','Refaccion');
    }


}
