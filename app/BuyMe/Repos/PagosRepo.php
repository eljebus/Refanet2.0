<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Pagos;

	class PagosRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Pagos;
	    }  

	    public function getAll(){

			return Pagos::where('Status','=','1');
		}


		public function newPay($array){

			$pago 			= new Pagos;

			$pago->Forma 	= $array['Forma'];
			$pago->Monto 	= $array['Monto'];
			$pago->Fecha	= date('Y-m-d');
			$pago->Activo 	= 1;
			$pago->Contrato	= $array['Contrato'];
			$pago->save();

			return $pago;

		}


	}