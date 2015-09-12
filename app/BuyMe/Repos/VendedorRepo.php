<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Vendedor;

	class VendedorRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Vendedor;
	    }  

	    public function getAll(){

			return Vendedor::where('Status','=','1');
		} 

		public function getByUser($userId){

			return Vendedor::where('Status','=','1')
						    ->where('Usuario','=',$userId)
						    ->first();
		}


		public function setConekta($array){

			$seller 			=  Vendedor::find(\Session::get('Seller'));
			$seller->Privada	= $array['Privada'];
			$seller->Publica 	= $array['Publica'];
			$seller->save();

			return true;

		}


		public function newSeller($usuario){

			$seller 				= 	new Vendedor;
			$seller->Usuario 		=   $usuario;
			$seller->Status 		= 	'1';
			$seller->save();

			return $seller;
		}

	}