<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Categoria;

	class CategoryRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Categoria;
	    }  


		public function getAll(){



			return Categoria::where('Status','=','1');
		}


		public function getByName($name){

			return Categoria::where('Nombre','=',$name)->first();
		}

		public function newCategory($array){

			$categoria 				= 	new Categoria;
			$categoria->Nombre		=	$array['Nombre'];
			//$categoria->Descripcion	=	$array['Descripcion'];
			$categoria->Descripcion = 	'Conocida';
			$categoria->Status 		= 	'1';
			$categoria->Img 		=	$array['Imagen'];
			$categoria->save();
		}

		



	}