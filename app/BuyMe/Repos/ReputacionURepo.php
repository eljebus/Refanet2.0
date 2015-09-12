<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\ReputacionU;

	class ReputacionURepo extends BaseRepo{

		public function getModel(){

	        return new ReputacionU;
	    }  


		public function getAll(){

			return ReputacionU::where('Status','=','1');
		}


		
		public function newRate($array){

			$cal 				= 	new ReputacionU;
			$cal->Usuario		= 	$array['Usuario'];
			$cal->Vendedor		=	$array['Vendedor'];
			$cal->Calificacion	=	$array['Calificacion'];
			$cal->Comentario	=	$array['Comentario'];
	
			$cal->save();


			return $cal;
		}

		 	



	}