<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Compra;

	class CompraRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Compra;
	    }  


		public function getAll(){

			return Compra::where('Status','=','F');
		}

		public function getAllForChart(){

			return Compra::where('compra.Status','=','F')
						 ->select(array('categoria.Nombre', \DB::raw('COUNT(*) as cantidad')))
						 ->join('publicacion','compra.publicacion','=','publicacion.idPublicacion')
						 ->join('categoria','publicacion.Categoria', '=', 'categoria.idCategoria')
						 ->groupBy('categoria')
						 ->get();

		}

		public function getAllByPublish($publicaciones){

			return Compra::where('Status','!=','E')
						 ->whereIn('Publicacion',$publicaciones)
						 ->orderBy('idCompra','DESC');
		}



		public function newBuy($array){



			$compra 				= new Compra;
			$compra->Fecha 			= date("Y-m-d");
			$compra->Forma 			= $array['forma'];
			$compra->Status 		= $array['status'];
			$compra->Oferta 		= $array['oferta'];
			$compra->Publicacion	= $array['publicacion'];

			$compra->save();

			return $compra;
		}

	}