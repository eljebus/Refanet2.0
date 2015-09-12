<?php  namespace App\Http\Controllers;


use View;
use Session;
use Input;
use Hash;
use Auth;
use Request;
use Response;
use Redirect;
//Carga de repositorios
use BuyMe\Repos\MarkRepo;
use BuyMe\Repos\CategoryRepo;
use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\RefaRepo;
use BuyMe\Repos\GaleriaRepo;
use BuyMe\Repos\PubliRepo;
use BuyMe\Repos\CompraRepo;
use BuyMe\Repos\TicketRepo;
use BuyMe\Repos\PreguntaRepo;
use BuyMe\Repos\SuscripcionesRepo;
use BuyMe\Repos\OfertaRepo;
use BuyMe\Repos\VendedorRepo;
use BuyMe\Repos\NotasRepo;
use BuyMe\Repos\ReputacionURepo;
use BuyMe\Repos\ComentarioRepo;
use BuyMe\Repos\ClienteRepo;
use BuyMe\Repos\ContratoRepo;
use BuyMe\Repos\PagosRepo;
use BuyMe\Repos\SugerenciasRepo;

use BuyMe\Middleware\Authenticate;



class AdminController extends Controller {

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
	protected $compras;
	protected $ticket;
	protected $pregunta;
	protected $oferta;
	protected $nota;
	protected $reputacion;
	protected $comentario;
	protected $cliente;
	protected $contrato;
	protected $pago;
	protected $seller;
	protected $suscripciones;
	protected $sugerencias;


	public function __construct(MarkRepo 		$marks,
							CategoryRepo 		$category, 
							UsersRepo 			$user,
							RefaRepo 			$refaccion,
							GaleriaRepo 		$galery,
							PubliRepo 			$public,
							CompraRepo 			$buy,
							TicketRepo 			$ticket,
							PreguntaRepo 		$pregunta,
							OfertaRepo 			$offer,
							ComentarioRepo		$comment,
							VendedorRepo 		$sell,
							NotasRepo 			$note,
							ReputacionURepo		$repu,
							ClienteRepo 		$client,
							ContratoRepo		$contract,
							PagosRepo			$pay,
							SugerenciasRepo		$suggestion,
							SuscripcionesRepo 	$suscriptions){



		//$this->middleware('auth');

		$this->marcas  		= $marks;
		$this->categorias 	= $category;
		$this->usuario 		= $user;
		$this->refa 		= $refaccion;
		$this->galeria 		= $galery;
		$this->publicacion 	= $public;
		$this->compras 		= $buy;
		$this->ticket 		= $ticket;
		$this->pregunta 	= $pregunta;
		$this->comentario 	= $comment;
		$this->oferta 		= $offer;
		$this->seller 		= $sell;
		$this->nota 		= $note;
		$this->reputacion 	= $repu;
		$this->contrato 	= $contract;
		$this->pago 		= $pay;
		$this->cliente 		= $client;
		$this->suscripciones= $suscriptions;
		$this->sugerencias  = $suggestion;

		$this->getData();

	}


	public function saveSuggestions(){

			//$marcas =  explode(',',Request::get('keywords'));

			$this->sugerencias->saveKeywords(Request::all());

			//dd(1);

			return Redirect::to('/Administrador/Perfil/'.Request::get('idUser'));

	}




	public function getChart(){


		//$compras  = $this->compras->getAllForChart();

		$compras  = $this->compras->getAllForChart();

		return View::make('/Admin/Administrador/chart')->with('compras',$compras);

	}



	public function saveQuestion(){
		
		if (Request::ajax()){

		
				
				$ticket 	= Request::get('Ticket');
				
				$data = array(

					'Contenido' 	=> Request::get('Contenido'),
					'Ticket'	  	=> $ticket
				);


				$pregunta 	= $this->pregunta->nuevaPregunta($data);

				return array('ok'=>true);	

		}

		else{

				$ticket 	= $this->ticket->newTicket(Request::all());

				$ticket 	= $ticket->idTicket; 

				$data = array(

					'Contenido' 	=> Request::get('Contenido'),
					'Ticket'	  	=> $ticket
				);


				$pregunta 	= $this->pregunta->nuevaPregunta($data);


				return Redirect::to('/Comprador/Soporte');

		}


	}

	protected function getData(){


			$usuario = Session::get('UserAdmin');

			
			$usuario = $this->usuario->find($usuario);
			$userName= $usuario->Nombre;

			$categorias = $this->categorias->getAll();



			$datos = array(
				'active' 	=> 'index',
				'user'	 	=>	$usuario,
				'userName'	=>	$userName,
				'categorias'=>  $categorias
			);


			View::share('dataUser', $datos);
	}



	public function deleteCategory($category){


		$category =  $this->categorias->find($category);

		$category->Status = 0;

		$category->save();

		return Redirect::to('Administrador/Categorias');

	}

	public function deleteMarck($marck){


		$marck =  $this->marcas->find($marck);

		$marck->Status = 0;

		$marck->save();

		return Redirect::to('Administrador/Marcas');

	}

	public function deleteUser($user){

		$user = $this->usuario->find($user);

		$user->Status = 0;

		$user->save();

		return Redirect::to('Administrador/');


	}

	public function getSearch(){


			$clientes 	= array();  

			$cliente 	=  Request::get('Cliente');

			$user 		= $this->usuario->find($cliente);


			$clientes 	= $this->usuario->getByName($cliente);

		
			$datos = array(
				'active' 	=> 'index',
				'usuarios'	=> $clientes->paginate(15),
				'query'		=> $cliente
			);

			if(!is_null($user))
				$datos['idClient'] =  $user;



			return View::make('/Admin/Administrador/search')->with('datos',$datos);



	}



	public function index(){


		
		//return View::make('/Admin/Comprador/index');
		$datos = array(
			'active' 	=> 'index',
			'usuarios'	=> $this->usuario->getAll()->paginate(12)
		);

		return View::make('/Admin/Administrador/index')->with('datos',$datos);

	}




	public function marcas()
	{

		$datos = array(
			'active' => 'marcas',
			'marcas' => $this->marcas
							 ->getAll()
							 ->paginate(12),

		);

		return View::make('/Admin/Administrador/marcas')->with('datos',$datos);;
	}


	public function categorias(){

		$datos = array(
			'active' => 'categorias',
			'categorias' => $this->categorias
							->getAll()
							->paginate(12),

		);


		return View::make('/Admin/Administrador/categorias')->with('datos',$datos);
	}


	public function soporte(){

		$tickets =  $this->ticket->getAll()->paginate(12);

		$datos = array(
			'active' => 'soporte',
			'tickets'=> $tickets
		);


		return View::make('/Admin/Administrador/soporte')->with('datos',$datos);
	}



	public function showProfile($user){


		$user 		=  	$this->usuario->find($user);



		$datos = array(
			'active' => 'index',
			'usuario'=> $user
		);

		if($user->vendedor()->count() != 0){

			$cliente 			= 	$this->cliente
											->getBySeller($user->vendedor()
													  			  ->first()
													  			  ->idVendedor);
			if(!is_null($cliente))
				$datos['cliente'] 	= 	$cliente;

		}

		//dd($datos);

		return View::make('/Admin/Administrador/userProfile')->with('datos',$datos);
	}


	public function newMark(){



		$datos = array(

			'active' 		=> 'marcas',
			'categorias' 	=> $this->categorias
									->getAll()
									->get()
		);


		return View::make('/Admin/Administrador/newMark')->with('datos',$datos);
	}

	public function saveMarck(){



			$file = Input::file('imagen');

			$nombre = null;

		    $path=public_path().'/images/Marcas/';

		 	if($file != null){

		    	$nombre=str_replace(' ','-',$file->getClientOriginalName());
		        // store our uploaded file in our uploads folder
		        $file->move($path, $nombre);

		 	}

		 	$data = array(

		 		'Nombre' 		=> Input::get('nombre'),
		 		'Descripcion'	=> Input::get('descripcion'),
		 		'Imagen'		=> $nombre
		 	);


		 	$marca = $this->marcas->newMark($data);

		 	foreach(Input::get('categoria') as $category){

		 		$marca->categoria()->attach($category);

		 	}

		 	



		 	return Redirect::to('Administrador/Marcas');
		   

	}


	public function newCategory(){

		$datos = array(
			'active' => 'categorias'
		);

		return View::make('/Admin/Administrador/newCategory')->with('datos',$datos);
	}

	public function saveCategory(){

			$file = Input::file('imagen');

			$nombre = null;

		    $path=public_path().'/images/Categorias/';

		 	if($file != null){

		    	$nombre=str_replace(' ','-',$file->getClientOriginalName());
		        // store our uploaded file in our uploads folder
		        $file->move($path, $nombre);

		 	}

		 	$data = array(

		 		'Nombre' 		=> Input::get('nombre'),
		 		'Descripcion'	=> Input::get('descripcion'),
		 		'Imagen'		=> $nombre
		 	);


		 	$this->categorias->newCategory($data);

		 	return Redirect::to('Administrador/Categorias');
		   

		/*if (Request::ajax()){

				$retorno;
				


				 $path=public_path().'/test/';;


				foreach ($_FILES as $key) {

					$name = $key['name'];

					move_uploaded_file($key['tmp_name'], $path.$name);
	
				}
				

				$retorno['Error']	=	'false';
				$retorno['accion'] 	=	'0';

				return Response::json($retorno);

			}*/



	}




	

	public function getTicket($ticket){


		$ticket =  $this->ticket->find($ticket);

		//dd($ticket->Asunto);

		$datos = array(
			'active' => 'soporte',
			'ticket' => $ticket
		);
		return View::make('/Admin/Administrador/ticket')->with('datos',$datos);
	}



	public function login(){


		if (Request::ajax()){

			$userdata = array(
            	'username' 	=> 	Input::get('user'),
            	'password'	=>	Input::get('pass')
        	);
        	
			$retorno=array(
   				'success'=>false
   				);
     

	        if(Auth::attempt($userdata)){
	            // De ser datos válidos nos mandara a la bienvenida
	           $retorno['success']=true;

	        }

			return Response::json($retorno);

		}


	}







}
