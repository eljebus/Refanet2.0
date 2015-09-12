<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Comentarios;

	class ComentarioRepo extends BaseRepo{

		public function getModel(){

	        return new Comentarios;
	    }  


		public function getAll(){

			return Comentarios::where('Status','=','1');
		}


		
		public function newComment($array){

			$Comentario 				= 	new Comentarios;
			$Comentario->date			=	date("Y-m-d");
			$Comentario->Comentario		=	$array['Comentario'];
			$Comentario->Oferta			= 	$array['Oferta'];
			$Comentario->Usuario		= 	\Session::get('User');
	
			$Comentario->save();


			return $Comentario;
		}

		 	



	}