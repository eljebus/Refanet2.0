<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Pregunta;

	class PreguntaRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Pregunta;
	    }  

	    public function getAll(){

			return Pregunta::where('Status','=','1');
		}


		public function nuevaPregunta($array){

			//dd($array);
			$pregunta 			  		= 	new Pregunta;
			$pregunta->Fecha		  	=	date("Y-m-d");
			$pregunta->status 	  		= 	1;
			$pregunta->Ticket 			= 	$array['Ticket'];
			$pregunta->Usuario 	  		= 	\Session::get('User');
			$pregunta->Contenido		= 	$array['Contenido'];
			$pregunta->save();

			return $pregunta;
		}




	}