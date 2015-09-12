<?php


namespace BuyMe\Entities;

class Marca extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'marca';
	protected 	$primaryKey 	= 'idMarca';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';



    public function categoria()
    {
        return $this->belongsToMany('BuyMe\Entities\Categoria', 'marca_categoria', 'Marca', 'Categoria');
    }

}
