<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Notas;

	class NotasRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Notas;
	    }  

	    public function getAll(){

			return Notas::where('Status','=','1');
		} 

		public function getByUser($userId){

			return Notas::where('Status','=','1')
						    ->where('Usuario','=',$userId)
						    ->first();
		}


		public function newNote($datos){

			$nota 				= 	new Notas;
			$nota->Contenido 	=   $datos['Contenido'];
			$nota->Status 		= 	'1';
			$nota->Fecha 		=  	date("Y-m-d");
			$nota->Url 			=  	$datos['Url'];
			$nota->Usuario		= 	$datos['Usuario'];
			$nota->Publicacion	= 	$datos['Publicacion'];
			$nota->save();

			return $nota;
		}

	}