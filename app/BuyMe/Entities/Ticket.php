<?php


namespace BuyMe\Entities;

class Ticket extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'ticket';
	protected 	$primaryKey 	= 'idTicket';
	public 		$timestamps 	= false;
	protected   $connection     = 'mysql';


    public function usuario(){

    	return $this->belongsTo('BuyMe\Entities\Cliente','Usuario');
    }

    public function preguntas(){

        return $this->hasMany('BuyMe\Entities\Pregunta','Ticket');
    }


  
}
