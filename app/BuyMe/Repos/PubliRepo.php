<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Publicacion;



	class PubliRepo extends BaseRepo{

		public function getModel(){

	        return new Publicacion;
	    }  


		public function getAll(){

			return Publicacion::where('Status','=','1');
		}

		public function getById($id){

			return Publicacion::where('Status','!=','0')
							  ->where('idPublicacion','=',$id)
							  ->first();
		}

		public function getByIdAndUser($id,$user){
			
						
			return Publicacion::where('Status','!=','0')
							  ->where('idPublicacion','=',$id)
							  ->where('Usuario','=',$user)
							  ->first();
		}

		public function getByIdSubscriptions($id,$suscripciones,$ofertasArray){

			return Publicacion::where('Status','=','1')
							  ->whereIn(	'Categoria'		,	$suscripciones)
							  ->whereNotIn('idPublicacion'	,	$ofertasArray)
							  ->whereNotIn('Usuario',[\Session::get('User')])
							  ->where('idPublicacion','=',$id)
							  ->first();

		}

		public function getAllBySuscription($suscripciones,$ofertasArray){

			return Publicacion::where('Status','=','1')
							  ->whereIn(	'Categoria'		,	$suscripciones)
							  ->whereNotIn('idPublicacion'	,	$ofertasArray)
							  ->whereNotIn('Usuario',[\Session::get('User')])
							  ->orderBy(	'idPublicacion'	,	'DESC');
		}



		public function getCategoryBySuscription($category,$ofertasArray){

			return Publicacion::where('Status','=','1')
							  ->where(	'Categoria'		,	$category)
							  ->whereNotIn('idPublicacion'	,	$ofertasArray)
							  ->whereNotIn('Usuario',[\Session::get('User')])
							  ->orderBy(	'idPublicacion'	,	'DESC');
		}


		public function registerPublic($array){

			//dd($array);
			$publicacion 			= 	new Publicacion;
			$publicacion->Fecha 	= date("Y-m-d");
			$publicacion->Status 	= 1;
			$publicacion->Refaccion = $array['refaccion'];
			$publicacion->Usuario 	= $array['Usuario'];
			$publicacion->Categoria = $array['Categoria'];
			$publicacion->save();
		


			return $publicacion;
		}


		public function getSearch($contenido){


			return Publicacion::where('Status','=','1')
							  ->where('Usuario','=',\Session::get('User'))
							  ->where('idPublicacion','=',$contenido)
							  ->first();
							  

		}

		



	}