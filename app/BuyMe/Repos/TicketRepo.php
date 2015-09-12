<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Ticket;

	class TicketRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Ticket;
	    }  

	    public function getAll(){

			return Ticket::where('Status','=','1');
		}

		public function getAllByUser(){

			return Ticket::where('Status','=','1')
						->where('Usuario','=',\Session::get('User'));
		}


		public function getTicketByUser($id){


			return Ticket::where('idTicket','=',$id)
						 ->where('Status','=','1')
						 ->where('Usuario','=',\Session::get('User'))
						 ->first();
		}


		public function newTicket($array){

			$ticket 			  = 	new Ticket;
			$ticket->Asunto		  =	 	$array['Titulo'];
			$ticket->Fecha		  =		date("Y-m-d");
			$ticket->Status 	  = 	'1';
			$ticket->Usuario 	  = 	\Session::get('User');
			$ticket->Departamento = 	$array['Departamento'];
			$ticket->save();

			return $ticket;
		}




	}