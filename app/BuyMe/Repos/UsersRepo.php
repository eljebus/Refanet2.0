<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Cliente;

	class UsersRepo extends BaseRepo{

		public function getModel()
	    {
	        return new Cliente;
	    }  

	    public function getAll(){

			return Cliente::where('Status','=','1');
		}

		public function verifyUserByMail($mail){

			return  Cliente::where('Mail','=',$mail)->count();
			
		}

		public function loginByMail($mail){

			return  Cliente::where('Mail','=',$mail)->first();

		}


		public function getByName($name){

			return  Cliente::where('Nombre','LIKE','%'.$name.'%');


		}


		public function auth($data){

			


			$user =  Cliente::where('Mail','=',$data['Mail'])
							->first();

			
			

			if(\Hash::check($data['password'], $user->password)){


				return $user;
			}


		}



		public function newUser($array){

			$user 				= 	new Cliente;
			$user->Nombre		=	$array['Nombre'];
			$user->Estado		=	$array['Estado'];
			$user->Municipio	=	$array['Municipio'];
			$user->Mail 		= 	$array['Mail'];
			$user->password 	=	$array['Clave'];
			$user->Avatar 		= 	$array['Avatar'];
			$user->Status 		= 	'1';
			$user->save();

			return $user;
		}

		public function editUser($array){

			

			$user 				=   Cliente::find(\Session::get('User'));
			$user->Nombre		=	$array['Nombre'];
			$user->Estado		=	$array['Estado'];
			$user->Municipio	=	$array['Municipio'];
			$user->Tel			= 	$array['Telefono'];
			$user->Mail 		= 	$array['Mail'];
			$user->Cp 			=   $array['Cp'];
			$user->Domicilio	=   $array['Domicilio'];

			//vaslidamos si cambio el avatar
			if($array['Avatar'] != "")
				$user->Avatar	= 	$array['Avatar'];

			//Validamos si la clave no tiene el valor de prueba
			if($array['Clave'] != "valor de prueba")
				$user->password 	=	\Hash::make($array['Clave']);

			$user->save();

			return $user;
		}




	}