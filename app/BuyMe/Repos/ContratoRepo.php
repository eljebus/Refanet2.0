<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Contrato;

	class ContratoRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Contrato;
	    }  

	    public function getAll(){

			return Contrato::where('Status','=','1');
		}

		public function getBySeller($seller){

			return Contrato::where('Status','=','1')
							->where('Clientes','=',$seller)
							->first();

		}

		public function getByDate($seller){

			$contrato 	= Contrato::where('Status','=','1')
								->where('Clientes','=',$seller)
								->first();

			$fin 		= $contrato->Fin;

			$hoy		= date('Y-m-d');

			$bandera 	= $fin < $hoy;


			if($bandera){

				$contrato->Status = 2;
				$contrato->save();
			}


			return $bandera;


		}

		public function newContract($cliente,$fin,$tipo){


			$contrato 			= new Contrato;

			$contrato->Inicio 	= date("Y-m-d");
			$contrato->Fin 	  	= $fin;
			$contrato->Fecha 	= date("Y-m-d");
			$contrato->Activo 	= 1;
			$contrato->Clientes = $cliente;
			$contrato->Tipo 	= $tipo;
			$contrato->save();

			return $contrato;

		}



	}