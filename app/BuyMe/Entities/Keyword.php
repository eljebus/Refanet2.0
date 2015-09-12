<?php


namespace BuyMe\Entities;

class Keyword extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected 	$table 			= 'keywords';
	protected 	$primaryKey 	= 'idKeywords';
	public 		$timestamps 	= false;
    protected   $connection     = 'mysql';

    public function __toString() {
    	
	    if(is_null($this->users_class)) {
	        return 'NULL';
	    }
	    return $this->user_class;
	}


 	public function vendedor(){

    	return $this->belongsTo('BuyMe\Entities\Vendedor','Vendedor');
    }


    
}
