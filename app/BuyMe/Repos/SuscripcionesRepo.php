<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Suscripciones;

	class SuscripcionesRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Suscripciones;
	    }  

	    public function getAll(){

			return Suscripciones::where('Status','=','1');
		} 

		public function getByIds($suscripcion){

			return Suscripciones::where('Marca',	'=',$suscripcion[1])
								->where('Categoria','=',$suscripcion[0])
								->where('Vendedor',	'=',$suscripcion[2])
								->first();

		}



		public function getAllBySeller($seller){


			return Suscripciones::where('Status',	'=',1)
								->where('Vendedor',	'=',$seller)
								->count();



		}


		public function quitById($id){

			Suscripciones::where('Vendedor','=',$id)->update(['Status' => '0']);

			return true;
		}




		public function updateById($suscripcion){

				Suscripciones::where(	'Marca',	'=',$suscripcion[1])
								->where('Categoria','=',$suscripcion[0])
								->where('Vendedor',	'=',$suscripcion[2])
								->update(['Status' => '1']);

				return true;
		
		}



		public function newSubscription($array){


			$suscripcion 			=  new Suscripciones;

			$suscripcion->Vendedor 	=  $array['Vendedor'];
			$suscripcion->Marca 	=  $array['Marca'];
			$suscripcion->Categoria	=  $array['Categoria'];
			$suscripcion->save();

			return $suscripcion;
		}

	}