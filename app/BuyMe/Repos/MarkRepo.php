<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Marca;

	class MarkRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Marca;
	    }  
	    public function getAll(){

			return Marca::where('Status','=','1');
		}

		public function getByName($name){

			return Marca::where('Nombre','=',$name)->first();
		}


		public function newMark($array){

			$marca 				= 	new Marca;
			$marca->Nombre		=	$array['Nombre'];
			$marca->Descripcion	=	'Conocida';
			$marca->Status 		= 	'1';
			$marca->Img 		=	$array['Imagen'];
			$marca->save();

			return $marca;
		}

	}