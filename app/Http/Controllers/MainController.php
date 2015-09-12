<?php namespace App\Http\Controllers;

use BuyMe\Repos\MarkRepo;
use BuyMe\Repos\CategoryRepo;
use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\RefaRepo;
use BuyMe\Repos\GaleriaRepo;
use BuyMe\Repos\PubliRepo;
use BuyMe\Repos\VendedorRepo;
use BuyMe\Repos\SuscripcionesRepo;
use BuyMe\Repos\ClienteRepo;
use BuyMe\Repos\ContratoRepo;
use BuyMe\Repos\PagosRepo;
use View;
use Session;
use Input;
use Hash;
use Auth;
use Request;
use Response;
use Redirect;
use DateTime;
use DateInterval;


class MainController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $marcas;
	protected $categorias;
	protected $usuario;
	protected $refa;
	protected $galeria;
	protected $publicacion;
	protected $vendedor;
	protected $suscripcion;
	protected $cliente;
	protected $contrato;
	protected $pago;


	public function __construct(MarkRepo 			$marks,
								CategoryRepo		$category, 
								UsersRepo 			$user,
								RefaRepo 			$refaccion,
								GaleriaRepo 		$galery,
								PubliRepo 			$public,
								VendedorRepo 		$seller,
								SuscripcionesRepo 	$subscription,
								ClienteRepo 		$client,
								ContratoRepo		$contract,
								PagosRepo			$pay){

			$this->marcas  		= $marks;
			$this->categorias 	= $category;
			$this->usuario 		= $user;
			$this->refa 		= $refaccion;
			$this->galeria 		= $galery;
			$this->publicacion 	= $public;
			$this->vendedor 	= $seller;
			$this->suscripcion  = $subscription;
			$this->cliente 		= $client;
			$this->contrato 	= $contract;
			$this->pago 		= $pay;


	}


	public function showTerms(){

		return View::make('terminos');
	}

	public function getPay(){

		if (Request::ajax()){

			\Conekta::setApiKey('key_w5B9koxHsk7MxCry');

			$plan 		= Request::get('Plan');
			$vendedor 	= Session::get('Seller');

			try {

				$intervalo = 'P1M';

				if(		$plan === 'Mes'){
					$precio =  400;
				}
					
				else if($plan === 'Anual'){

					$precio 	= 3990;
					$intervalo 	= 'P1Y';

				}
					
				else if($plan === 'Semestral'){

					$precio 	= 2000;
					$intervalo 	= 'P6M';
				}
					

				$cliente	= $this->cliente->newClient($vendedor);

				$fecha 		= new DateTime(date("Y-m-d"));
				$intervalo 	= new DateInterval($intervalo);

				$fin 		= $fecha->add($intervalo);

				$contrato 	= $this->contrato->newContract($cliente->idClientes,$fin,$plan);

				//Creamos la sesion de contrato para mostrar los datos al final
				Session::put('Contrato',$contrato->idContrato);


				$charge 			= \Conekta_Charge::create(array(

					"amount"		=> $precio * 100,
					"currency"		=> "MXN",
					"description"	=> "Pago ".Request::get('Plan').
									   ' del vendedor '
									   .$vendedor,
					"reference_id"	=> $contrato->idContrato.'/'.$cliente->idClientes,
					"card"			=> Request::get('Token')

				));


			
				if($charge->status === 'paid'){

					$data = array(

						'Forma'		=>'Tarjeta de crédito',
						'Monto'		=> $precio,
						'Contrato'	=> $contrato->idContrato
					);


					$pago =  $this->pago->newPay($data);

					return array('ok'=>true);	

				}
				else
					return array('ok'=>false);	
				


			} catch (Conekta_Error $e) {
			  echo $e->getMessage();
			  //El pago no pudo ser procesado
			}



		}

	}

	public function showCategories(){


		$datos = array(
			'categorias' => $this->categorias->getAll()->get()
		);

		//dd($this->categorias->getAll()->count());

		return View::make('index')->with('datos',$datos);
	}


	public function show($category){



		
		$categoria = $this->categorias->getByName($category);



	  if(!$categoria){

			   return '404: No se encuentra la pagina';
		}
		


		//Se crea la sesion para la categoria
		Session::put('categoria', $categoria->Nombre);



		return View::make('begin');

	}

	public function register($user,$etapa = null){
		
		$url 	= '';
		$datos 	= array();

		if($user === 'Comprador'){

			switch ($etapa) {

				case 'inicio':
					$url = 'register';				
					break;

				
			}

		}
		elseif($user === 'Vendedor'){

			switch ($etapa) {

				case 'inicio':
					$url = 'registerSeller';				
					break;

			}
		}

		else
			return '404: No se encuentra la pagina';;


		return View::make( $url )->with('datos',$datos);

	}


	public function finishSeller(){


		$vendedor = $this->vendedor->find(Session::get('Seller'));
		//$contrato = $this->contrato->find(Session::get('Contrato'));
		$contrato = $this->contrato->find(1);



		$datos=array(

			'vendedor'  => $vendedor,
			'contrato'	=> $contrato
		);

		return View::make( 'finishSeller' )->with('datos',$datos);

	}




	public function login(){

		if (Request::ajax()){





			//dd(Request::all());

			$userdata 		= array(

            	'Mail' 		=> 	Input::get('mail'),
            	'password'	=>	Input::get('clave')
        	);


        	$retorno = array(
					'Error' => false
				);

        	$admin = $this->usuario->auth($userdata);

        	if(!is_null($admin)){


        		if($admin->Mail === 'admin@refanet.com' ){

        			\Session::put('UserAdmin',$admin->id);
        			\Session::put('User',$admin->id);


        			$retorno['url'] = '/Administrador';

        			return Response::json($retorno);


        		}
        	}

  

        	$retorno['url'] = '/Comprador';

        	

			if(Auth::attempt($userdata,true)){
				
	            // De ser datos válidos se creara la sesion


	            Session::put('User',Auth::getUser()->id);



	            if(!is_null($this->vendedor->getByUser(Auth::getUser()->id)))
	            	Session::put('Seller',$this->vendedor
	            							   ->getByUser(Auth::getUser()->id)
	            							   ->idVendedor);

	            $retorno['url'] = '/Vendedor';

	        }

	        else{

	        	$retorno['Error'] = true;
	        }
				

				
				return Response::json($retorno);
			}

	}

	public function loginFb(){


		if (Request::ajax()){


				//dd(Request::all());

				$perfil 	=  Request::get('perfil');

				$user 		= $this->usuario->loginByMail($perfil['email']);

				$retorno 	= array(

					'Error' => false,
					'url'	=> 'Comprador'
				);

		        Session::put('User',$user->id);


				
				return Response::json($retorno);
			}

	}



	public function registerUser(){


		$mail 				= Input::get('mail');

		$userCount 			= $this->usuario->verifyUserByMail($mail);

		$categoria 			= $this->categorias->getByName(Session::get('categoria'));


		$categorias			=  $this->categorias->getAll()->get();


		$categoria 			= array(

				'categoria'	=> $categoria,
				'categorias'=> $categorias
		);


		if( $userCount >= 1 ){

			$userdata 		= array(

            	'Mail' 		=> 	$mail,
            	'password'	=>	Input::get('clave')
        	);


			if(Auth::attempt($userdata,true)){

	            // De ser datos válidos nos mandara a la bienvenida

	           Session::put('User',Auth::getUser()->id);
	           return Redirect::to('/Comprador/Nueva');

	        }


	        else{

	        	return Redirect::to('/');
	        }
		}

	
		else{

			$domicilio 		= Input::get('domicilio');

			$domicilio 		= explode(',',$domicilio);

			$data 			= array(

				'Nombre' 	=> Input::get('name'),
				'Municipio' => (array_key_exists(0,$domicilio)? $domicilio[0] : ''),
				'Estado'	=> (array_key_exists(1,$domicilio)? $domicilio[1] : ''),
				'Mail'		=> $mail,
				'Clave'		=> Hash::make(Input::get('clave')),
				'Avatar'	=> (!Input::get('foto')===""?  Input::get('foto'): '/images/images/avatar.png'),

			);

			$newUser 		= $this->usuario->newUser($data);

			//Al crear un nuevo usuario se crea un directorio para sus archivos
		
			$directorio 	=  public_path().'/images/Usuarios/'.$mail;

			if (!file_exists($directorio)) 
				mkdir("$directorio", 0777); 
		
			

			$userdata 		= array(
            	'Mail' 		=> 	$newUser->Mail,
            	'password'	=>	Input::get('clave'),
				'Status'	=>  1
        	);

			

        	//Auth::attempt($userdata,true);


        	Session::put('User',$newUser->id);


        	//Si es un registro de vendedor se registra como tal

        	if(!is_null(Request::get('Vendedor'))){

        		$seller 				= $this->vendedor->newSeller($newUser->id);

        		Session::put('Seller',$seller->idVendedor);

        		$datos['categorias'] 	= $this->categorias->getAll();	 

        		return View::make('subscriptions')->with('datos',$datos);

        	}

			return View::make('detailsRegister')->with('categoria',$categoria);


		}


		return View::make('detailsRegister')->with('categoria',$categoria);

	}



	public function registerSubscriptions(){

		$categorias = Request::get('categorias');
		$marcas 	= Request::get('marcas');

		foreach($categorias as $categoria){

			foreach ($marcas as $marca ) {
				
				$data = explode('/',$marca);

				if($data[0] === $categoria){

					$datos = array(
						'Categoria' => $data[0],
						'Marca' 	=> $data[1],
						'Vendedor'	=> Session::get('Seller')
					);

					$this->suscripcion->newSubscription($datos);

				}
			}

		}

		return Redirect::to('/Registro/Vendedor/Metodo');



	}


	public function registerPay(){

		 if(\Session::has('Codigo')){

		 	return Redirect::to('/Vendedor');
		 }

		return View::make('methodSeller');


	}



	public function registerDevice(){


		if (Request::ajax()){


				$usuario 	= $this->usuario->find(Session::get('User'));


				$categoria 	= $this->categorias->find(Request::get('category'));



				$marca 		= $this->marcas->find(Input::get('marck'));

				$data = array(

						'Nombre'		=> Input::get('name'),
						'Tipo'			=> Input::get('type'),
						'Marca'			=> $marca->idMarca,
						'Modelo'		=> Input::get('model'),
						'Descripcion'	=> Input::get('description'),
						'status'		=> '2'

					);

				$newRefa = $this->refa->nuevaRefaccion($data);



				$path =  public_path().'/images/Usuarios/'.$usuario->Mail.'/';

				foreach ($_FILES as $key) {
					//dd(1);
					$name = $key['name'];

					move_uploaded_file($key['tmp_name'], $path.$name);

					$photo = array(
						'nombre' 	=> 	$name,
						'path' 		=>	'/images/Usuarios/'.$usuario->Mail.'/'.$name,
						'refa'		=>  $newRefa->idRefaccion,
					);

					$galery =  $this->galeria->newPhoto($photo);
	
				}

			$dataPublic =  array(
				'refaccion' 	=> $newRefa->idRefaccion,
				'Usuario'		=> $usuario->id,
				'Categoria'		=> $categoria->idCategoria,
			);


		//dd($dataPublic);

	
			$public = $this->publicacion->registerPublic($dataPublic);



			// Se crea la seccion con el objeto pieza
			Session::put('publicacion', $public->idPublicacion);

			return array('ok'=>true);	

			
		}

	}

	public function finishBuyer(){

		$public =  $this->publicacion->find(Session::get('publicacion'));


		$datos = array(	

			'pieza' 	=> $public->refaccion()->first(),
			'user' 		=> $public->usuario()->first(),
			'categoria'	=> $public->categoria()->first()->Nombre,
			'marca'   	=> $public->refaccion()->first()->marca()->first()->Nombre
		);
		


		return View::make('finishRegister')->with('datos',$datos);
	}

	public function publicar(){

		$public = $this->publicacion->find(Session::get('publicacion'));

		$public->Status = 1;

		$public->save();

		return Redirect::to('/Comprador');
	}

	public function setMarcks($category){

		if (Request::ajax()){

			$categoria = $this->categorias->find($category);

			return $categoria->marcas()->get();
		}
	}

	


}
