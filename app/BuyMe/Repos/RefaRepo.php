<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Refaccion;

	class RefaRepo extends BaseRepo{

		public function getModel(){

	        return new Refaccion;
	    }  


		public function getAll(){

			return Refaccion::where('Status','=','1');
		}

		public function getSearch($contenido){

			return Refaccion::where('Status','=','1')
							->where('Nombre','LIKE','%'.$contenido.'%')
							->orderBy('idRefaccion','DESC');
		}

		public function getSearchByRefa($contenido,$refacciones){

			return Refaccion::where('Status','=','1')
							->where('Nombre','LIKE','%'.$contenido.'%')
							->whereIn('idRefaccion',$refacciones)
							->orderBy('idRefaccion','DESC');
		}


		public function getSuggestions($refaccionesArray,$seller){

				

			$refacciones	=  Refaccion::where('Status','=','1')
										->orderBy('idRefaccion','DESC')
										->whereIn('idRefaccion',$refaccionesArray);;


			$meta 		= '';

			$keywords 	= $seller->keywords()->where('Status','=','1');


			if($keywords->count() > 0){

				$flag = '( ';

				foreach ($keywords->get() as $key) {

					$meta.=$flag."Nombre like '%".$key->Meta."%' ";

					$flag = 'or ';

				}

				$meta.=')';


				$refacciones = $refacciones->whereRaw($meta);

			}
			else
				$refacciones = null;

		


			return $refacciones;
		}


		public function editarRefaccion($array,$id){

			$refaccion 				=   Refaccion::where('idRefaccion','=',$id)->first();
			$refaccion->Nombre		=	$array['Nombre'];
			$refaccion->Descripcion	=	$array['Descripcion'];
			$refaccion->Tipo		= 	$array['Tipo'];
			$refaccion->Modelo 		=  	$array['Modelo'];
			$refaccion->Marca 		= 	$array['Marca'];
			$refaccion->save();


			return $refaccion;
		}

		public function nuevaRefaccion($array){

			$refaccion 				= 	new Refaccion;
			$refaccion->Nombre		=	$array['Nombre'];
			$refaccion->Descripcion	=	$array['Descripcion'];
			$refaccion->Status 		= 	'1';
			$refaccion->Tipo		= 	$array['Tipo'];
			$refaccion->Modelo 		=  	$array['Modelo'];
			$refaccion->Marca 		= 	$array['Marca'];
			$refaccion->save();


			return $refaccion;
		}

		



	}