<?php


namespace BuyMe\Entities;

class Categoria extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'categoria';
	protected 	$primaryKey 	= 'idCategoria';
	public 		$timestamps 	= false;
	protected 	$connection 	= 'mysql';



    public function marcas()
    {
       return $this->belongsToMany('BuyMe\Entities\Marca', 'marca_categoria', 'Categoria', 'Marca');
    }

    public function usuarios()
    {
       return $this->belongsToMany('BuyMe\Entities\Cliente', 'categoria_usuario', 'Usario', 'Categoria');
    }

}
