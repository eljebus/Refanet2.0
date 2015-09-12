<?php namespace App\Http\Controllers;

use BuyMe\Repos\MarkRepo;
use BuyMe\Repos\CategoryRepo;
use BuyMe\Repos\UsersRepo;
use BuyMe\Repos\RefaRepo;
use BuyMe\Repos\GaleriaRepo;
use BuyMe\Repos\PubliRepo;
use BuyMe\Repos\TicketRepo;
use BuyMe\Repos\PreguntaRepo;
use BuyMe\Repos\ComentarioRepo;
use BuyMe\Repos\OfertaRepo;
use BuyMe\Repos\NotasRepo;
use BuyMe\Repos\CompraRepo;
use BuyMe\Repos\ReputacionVRepo;
use View;
use Session;
use Input;
use Hash;
use Auth;
use Request;
use Response;
use Redirect;
use BuyMe\Middleware\Authenticate;

class BuyerController extends Controller {

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
	protected $comentario;
	protected $oferta;
	protected $nota;
	protected $compra;
	protected $reputacion;



	public function __construct(MarkRepo 		$marks,
								CategoryRepo 	$category, 
								UsersRepo 		$user,
								RefaRepo 		$refaccion,
								GaleriaRepo 	$galery,
								PubliRepo 		$public,
								CompraRepo 		$buy,
								TicketRepo 		$ticket,
								PreguntaRepo 	$pregunta,
								ComentarioRepo	$comment,
								OfertaRepo 		$offer,
								NotasRepo 		$note,
								CompraRepo		$buy,
								ReputacionVRepo $rep){

			$this->middleware('auth');

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
			$this->nota 		= $note;
			$this->compra 		= $buy;
			$this->reputacion 	= $rep;

			$this->getData();



	}


	public function nuevaPublicacion(){

		$categoria 	= $this->categorias->getByName(Session::get('categoria'));
		$categorias = $this->categorias->getAll()->get();



		$datos = array(
			'active' 		=> 'index',
			'categoria'		=> $categoria,
			'categorias'   	=> $categorias 
		);

	
		return View::make('/Admin/Comprador/nueva')->with('datos',$datos);
	}




	protected function getCategory($category){


		if($category === 'all')
			return Redirect::to('/Comprador/');

		$usuario = Session::get('User');
		$usuario = $this->usuario->find($usuario);

		$publicaciones = $usuario->publicaciones()
								 ->where('Status','=','1')
								 ->where('Categoria','=',$category)
								 ->orderBy('idPublicacion','DESC')
								 ->paginate(5);


		$datos = array(
			'active' 		=> 'index',
			'publicaciones'	=> $publicaciones,
			'category'		=> $category
		);

		return View::make('/Admin/Comprador/index')->with('datos',$datos);

	}



	protected function search(){


			$contenido 		= Request::get('Contenido');

			$usuario 		= Session::get('User');
			$usuario 		= $this->usuario->find($usuario);



			$id 			= 	$usuario->publicaciones()
									 ->where('Status','!=','0')
									 ->where('idPublicacion','=',$contenido)
									 ->first();


			$pubId  = '';

			if(!is_null($id))
				$pubId = $id->idPublicacion;

			$refacciones 	=  	$this->refa
									->getSearch($contenido)
									->select('idRefaccion')
									->get()
									->toArray();

			$publicaciones 	= $usuario->publicaciones()
									 ->where('Status','!=','0')
									 ->whereIn('Refaccion',$refacciones)
									 ->where('idPublicacion','!=',$pubId)
									 ->paginate(5);


			//dd($arrayPublicaciones);

			//return Response::json($arrayPublicaciones);

			$datos = array(
				'active' 			=> 'index',
				'publicaciones'		=> $publicaciones,
				'publicacionesId'	=> $id,
				'busqueda'			=> $contenido
			
			);

				
			return View::make('/Admin/Comprador/search')->with('datos',$datos);

		
	}

	protected function getData(){


			$usuario = Session::get('User');

			
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




	public function index(){

		$usuario = Session::get('User');
		$usuario = $this->usuario->find($usuario);

		$publicaciones = $usuario->publicaciones()
								 ->where('Status','=','1')
								 ->orderBy('idPublicacion','DESC')
								 ->paginate(5);


		$datos = array(
			'active' 		=> 'index',
			'publicaciones'	=> $publicaciones
		);

		return View::make('/Admin/Comprador/index')->with('datos',$datos);
	}


	public function profile(){


		$datos = array(
			'active' 		=> 'index'
		);



		return View::make('/Admin/Comprador/profile')->with('datos',$datos);
	}







	public function edit($publicacion){


		$user  			= Session::get('User');
		$publicacion 	= $this->publicacion->getByIdAndUser($publicacion,$user);

		if(is_null($publicacion))
			return "Página no encontrada";

		$datos = array(
			'active' 		=> 'index',
			'publicacion'	=> $publicacion
		);

	
		return View::make('/Admin/Comprador/edit')->with('datos',$datos);
	}



	public function post($post){

		$user 			= Session::get('User');

		$publicacion 	= $this->publicacion->getByIdAndUser($post,$user);



		if($publicacion->notas()->count() > 0 ){

			foreach ($publicacion->notas()->get() as $nota) {
				
				if($nota->Usuario === Session::get('User')){

					$nota->Status = '2';
					$nota->save();
				}
					 

			}
		}


		$datos = array(

			'active' 	=> 'index',
			'post' 		=> $publicacion,
			'galeria'	=> $this->galeria
								->getAll()
								->where('Refaccion','=',$publicacion->refaccion()
																	->first()
																	->idRefaccion)
		);

		return View::make('/Admin/Comprador/post')->with('datos',$datos);
	}


	public function compras(){

		$usuario 		= Session::get('User');
		$usuario 		= $this->usuario->find($usuario);
		$publicaciones 	= $usuario->publicaciones()
								  ->where('Status','!=','0')
								  ->select('idPublicacion')
								  ->get();

		$publishArray = array();

		foreach ($publicaciones as $publish) {

			array_push($publishArray, $publish->idPublicacion);
		}




		$compras 		= $this->compras->getAllByPublish($publishArray)
										->paginate(5);


		$datos = array(
			'active' => 'compras',
			'compras'=> $compras
		);
		
		return View::make('/Admin/Comprador/compras')->with('datos',$datos);
	}

	public function finish($offer){

		$compra  		= $this->compra->find($offer);



		$publicacion 	= $compra->publicacion()->first();

		if(!$this->publicacion->getByIdAndUser($publicacion->idPublicacion,\Session::get('User')))
			return '404';

		$datos = array(

			'active' 		=> 'compras',
			'publicacion'	=> $publicacion,
			'compra'		=> $compra,
			'oferta'		=> $compra->oferta()->first()
		
		);




		return View::make('/Admin/Comprador/finalizar')->with('datos',$datos);
	}


	public function listaSoporte(){


		$datos = array(
			'active' => 'soporte',
			'ticket' =>  $this->ticket->getAllByUser()->paginate(20)
		);
		return View::make('/Admin/Comprador/listaSoporte')->with('datos',$datos);
	}




	public function soporte(){
		

		$datos = array(
			'active' => 'soporte'
		);

		return View::make('/Admin/Comprador/soporte')->with('datos',$datos);
	}



	public function getTicket($ticket){


		$ticket =  $this->ticket->getTicketByUser($ticket);

		//dd($ticket->Asunto);

		$datos = array(
			'active' => 'soporte',
			'ticket' => $ticket
		);
		return View::make('/Admin/Comprador/ticket')->with('datos',$datos);
	}


	public function makeComment(){

		if (Request::ajax()){


			//dd(Request::all());
			$comentario = $this->comentario->newComment(Request::all());
			$oferta 	= $this->oferta->find(Request::get('Oferta'));

			$dataNote = array(

				'Usuario'		=> $oferta->vendedor()->first()->Usuario,
				'Contenido'		=> '<strong>'.$oferta->publicacion()->first()->refaccion()->first()->Nombre.'</strong> tiene un nuevo comentario',
				'Url'			=> '/Vendedor/Oferta/'.$oferta->idOferta,
				'Publicacion'	=> $oferta->publicacion()->first()->idPublicacion

			);

			$this->nota->newNote($dataNote);

			$retorno = array(
				'ok' => true
			);

			return Response::json($retorno);
		}
	}

	public function getProfile(){

		if (Request::ajax()){

			$retorno = array(
				'Error' => false,

			);

			if(Session::get('Oferta')){

				$oferta 			= $this->oferta->find(Session::get('Oferta'));

				$oferta->Estado     = 'B';

				$oferta->save();

				$publicacion 		= $oferta->publicacion()->first();

				$publicacion->Status= '2';

				$publicacion->save();

				$dataBuy 			= array(

											'forma' 		=> 'Contacto Directo',
											'status'		=> 'P',
											'oferta'		=> $oferta->idOferta,
											'publicacion' 	=> $publicacion->idPublicacion
									  ); 

				$compra 			= $this->saveBuy($dataBuy);

				$usuario 			= $oferta->vendedor()->first()->usuario()->first();

				$vendedor 			= $usuario->vendedor()->first();

				$retorno['Usuario'] = $usuario;


				$retorno['Calificacion'] = round($vendedor->reputacion()->avg('Calificacion'), 0, PHP_ROUND_HALF_UP);

			}


			

			return Response::json($retorno);
		}
	}


	public function saveBuy($array){



		$compra = $this->compra->newBuy($array);

		$dataNote = array(

			'Usuario'		=> $compra->oferta()
									->first()
									->vendedor()
									->first()
									->Usuario,

			'Contenido'		=> 'Han realizado la compra de la pieza <strong>'.
								$compra->oferta()
										->first()
										->publicacion()
										->first()
										->refaccion()
										->first()
										->Nombre.'</strong> ',

			'Url'			=> '/Vendedor/Oferta/'.$compra->oferta()
															->first()
															->idOferta,

			'Publicacion'	=> $compra->oferta()
									->first()
									->publicacion()
									->first()
									->idPublicacion

		);

		$this->nota->newNote($dataNote);

		return $compra;

	}


	public function saveProfile(){



		$datos 				= Request::all();
		$datos['Avatar']	= '';

		if(array_key_exists('avatar', Request::all())){

			if (Input::file('avatar')->isValid()) {

			      $path 		= public_path().'/images/Usuarios/'.Request::get('Mail').'/';
			      $extension 	= Input::file('avatar')->getClientOriginalExtension(); // getting image 

			      $fileName 	= Request::get('Mail').'.'.$extension; // renameing image
			      Input::file('avatar')->move($path, $fileName); // uploading file to given 

				  $datos['Avatar']	= '/images/Usuarios/'.Request::get('Mail').'/'.$fileName;
			}


		}
		


		

		//dd($datos)
		$this->usuario->editUser($datos);




		return Redirect::to('/Comprador/perfil');
	}


	public function buy($post){



		$oferta = $this->oferta->find($post);

		Session::put('Oferta',$oferta->idOferta);


		$datos = array(
			'active' => 'select',
			'oferta' => $oferta	
		);

		return View::make('/Admin/Comprador/buy')->with('datos',$datos);


	}

	public function card(){

		$datos = array(
			'active' => 'select'
		);

		return View::make('/Admin/Comprador/card')->with('datos',$datos);

	}

	public function direct(){

		$datos = array(
			'active' => 'select'
		);

		return View::make('/Admin/Comprador/direct')->with('datos',$datos);

	}



	public function editDevice(){


		if (Request::ajax()){

				$usuario 	= $this->usuario->find(Session::get('User'));
				$marca 		= $this->marcas->find(Input::get('marck'));



				$data = array(

						'Nombre'		=> Input::get('name'),
						'Tipo'			=> Input::get('type'),
						'Marca'			=> $marca->idMarca,
						'Modelo'		=> Input::get('model'),
						'Descripcion'	=> Input::get('description')

				);

				//Guardamos la ediciones
				$editRefa = $this->refa->editarRefaccion($data,Input::get('id'));

				$path =  public_path().'/images/Usuarios/'.$usuario->Mail.'/';

				foreach ($_FILES as $key) {
					//dd(1);
					$name = $key['name'];

					move_uploaded_file($key['tmp_name'], $path.$name);

					$photo = array(
						'nombre' 	=> 	$name,
						'path' 		=>	'/images/Usuarios/'.$usuario->Mail.'/'.$name,
						'refa'		=>  Input::get('id'),
					);

					$galery =  $this->galeria->newPhoto($photo);
	
				}

				//Eliminamos las imagenes que fueron removidas
				$this->galeria->removePhoto(explode(',',Input::get('deletedImg')));


			
			return array('ok'=>true);	

			
		}

	}

	public function registerDevice(){


		if (Request::ajax()){


				$usuario 	= $this->usuario->find(Session::get('User'));

				$categoria 	= $this->categorias->find(Request::get('category'));


				$marca 		= $this->marcas->find(Input::get('marck'));

				$data 		= array(

								'Nombre'		=> Input::get('name'),
								'Tipo'			=> Input::get('type'),
								'Marca'			=> $marca->idMarca,
								'Modelo'		=> Input::get('model'),
								'Categoria'		=> $categoria->idCategoria,
								'Descripcion'	=> Input::get('description')

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
				'refaccion' => $newRefa->idRefaccion,
				'Usuario'	=> $usuario->id,
				'Status'	=> 1,
				'Categoria' => $categoria->idCategoria
			);



	
			$public = $this->publicacion->registerPublic($dataPublic);



			// Se crea la seccion con el objeto pieza
			//Session::put('publicacion', $public->idPublicacion);

			return array('ok'=>true);	

			
		}

	}

	public function BuyerExit(){

		//Finaliza sesión
		Session::flush();

		return Redirect::to('/');

	}

	public function deleteItem($item){


		$publicacion 			= $this->publicacion->find($item);

		$publicacion->Status 	= 0;

		$publicacion->save();


		return Redirect::to('/Comprador');

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


	public function finishBuy(){


		$compra 		= $this->compras->find(Request::get('compra'));

		if($compra->Status === 'C')
			$compra->Status = 'F';

		else
			$compra->Status = 'T';

		$compra->save();



		$dataRepu =  array(

			'Usuario'		=> 	$compra->publicacion()
										->first()
										->Usuario,
			'Vendedor'		=>	$compra->getOfferBuy()->Vendedor,
			'Calificacion'	=>	Request::get('Calificacion'),
			'Comentario'	=>	Request::get('Comentario')
		);

		$rate = $this->reputacion->newRate($dataRepu);

		return Redirect::to('/Comprador/Compras');

		
		

	}



}
