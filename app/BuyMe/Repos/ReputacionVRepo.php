<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\ReputacionV;

	class ReputacionVRepo extends BaseRepo{

		public function getModel(){

	        return new ReputacionV;
	    }  


		public function getAll(){

			return ReputacionV::where('Status','=','1');
		}


		
		public function newRate($array){

			$cal 				= 	new ReputacionV;
			$cal->Usuario		= 	$array['Usuario'];
			$cal->Vendedor		=	$array['Vendedor'];
			$cal->Calificacion	=	$array['Calificacion'];
			$cal->Comentario	=	$array['Comentario'];
	
			$cal->save();


			return $cal;
		}

		 	



	}