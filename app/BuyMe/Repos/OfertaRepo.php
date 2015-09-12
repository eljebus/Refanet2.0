<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Ofertas;

	class OfertaRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Ofertas;
	    }  


		public function getAll(){

			return Ofertas::where('Status','=','1')->get();
		}

		public function getAllByUser($seller){

			return Ofertas::where('Vendedor','=',$seller);
		}



		public function newOffer($array){


			$Ofertas 				= 	new Ofertas;
			$Ofertas->Precio		=	$array['Precio'];
			$Ofertas->Publicacion	=	$array['Publicacion'];
			$Ofertas->Status 		= 	'1';
			$Ofertas->Vendedor		=   \Session::get('Seller');
			$Ofertas->Estado 		=	$array['Estado'];
			$Ofertas->refaccion     =   $array['Refaccion'];
			$Ofertas->TiempoE 		=   $array['TiempoE'];
			$Ofertas->save();

			return $Ofertas;
		}

		public function modifyOffer($array,$oferta){


			$Ofertas 				= 	Ofertas::where('idOferta','=',$oferta)->first();

			$Ofertas->Precio		=	$array['Precio'];
			$Ofertas->Estado 		=	$array['Estado'];
			$Ofertas->TiempoE 		=   $array['TiempoE'];
			$Ofertas->save();

			return $Ofertas;
		}


		public function verifyOffer($ofer,$seller){



			$oferta 	= 	Ofertas::where('Status','!=','0')
								   ->where('idOferta','=',$ofer)
								   ->where('Vendedor','=',$seller)
								   ->first();
			if(!is_null($oferta))
				return true;
			else
				return false;					   

		}

		



	}