<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\ClienteC;

	class ClienteRepo extends BaseRepo{

		public function getModel()
	    {
	        return new ClienteC;
	    }  

	    public function getAll(){

			return ClienteC::where('Status','=','1');
		}

		public function getBySeller($seller){

			return ClienteC::where('Activo','=',1)
							->where('Usuario','=',$seller)
							->first();
		}



		public function newClient($seller){

			$user 				= 	new ClienteC;
			$user->Fecha		=	date("Y-m-d");
			$user->Activo		= 	1;
			$user->Usuario		= 	$seller;
			$user->save();

			return $user;
		}

		


	}