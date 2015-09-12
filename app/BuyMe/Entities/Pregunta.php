<?php


namespace BuyMe\Entities;

class Pregunta extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'pregunta';
	protected 	$primaryKey 	= 'idPregunta';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';


    public function ticket(){

        return $this->belongsTo('BuyMe\Entities\Ticket','Ticket');
    }

    public function usuario(){

        return $this->belongsTo('BuyMe\Entities\Cliente','Usuario');
    }



  
}
