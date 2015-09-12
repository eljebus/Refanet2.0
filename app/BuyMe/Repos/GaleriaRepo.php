<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Galeria;

	class GaleriaRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Galeria;
	    }  

	    public function getAll(){

			return Galeria::where('Status','=','1');
		}

		
		public function removePhoto($array){


			foreach ($array as $key) {
					
				$photo 			= Galeria::find($key);

				if(!is_null($photo)){
					
					$photo->Status 	= 0;
					$photo->save();
				}
				
			}

		}


		public function newPhoto($array){

			$galery 			= 	new Galeria;
			$galery->Nombre  	=  	$array['nombre'];
			$galery->Archivo 	= 	$array['path'];
			$galery->Refaccion	= 	$array['refa']; 
			$galery->Status  	=	1;
			$galery->save();

			return $galery;
		}

	}