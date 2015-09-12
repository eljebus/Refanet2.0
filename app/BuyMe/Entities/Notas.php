<?php


namespace BuyMe\Entities;

class Notas extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'notificaciones';
	protected 	$primaryKey 	= 'idNotificaciones';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';



    public function usuario(){

        return $this->belongsTo('BuyMe\Entities\Cliente');
    }



   

}
