<?php namespace App\Http\Controllers;

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

use BuyMe\Middleware\Authenticate;



class SellerController extends Controller {

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

		

		$this->getData();

	}


	protected function getSuggestions(){


		$user 			= $this->usuario->find(Session::get('User'));
		$vendedor 		= $user->vendedor()->first();
		$ofertas 		= $vendedor->ofertas()->get();

		$suscripciones  = array();
		$ofertasArray 	= array();

			foreach ($vendedor->suscripciones()
							->where('Status','=','1')
						  	->select('Categoria')
						  	->get()
						  	->toArray() as $categoria) {

		 		array_push($suscripciones,$categoria['Categoria']);
		} 	


		foreach ($ofertas as $oferta ) {
			
			array_push($ofertasArray, $oferta->publicacion()->first()->idPublicacion);
		}


		$contenido 		= 	Request::get('Contenido');

		$id 			= 	$this->publicacion
								 ->getByIdSubscriptions(	$contenido,
															$suscripciones,
															$ofertasArray);

		$refaSusb		= 	$this->publicacion
								 ->getAllBySuscription($suscripciones,$ofertasArray)
								 ->select('Refaccion')
								 ->get()
								 ->toArray();

		$refacciones 	= $this->refa
							  ->getSuggestions($refaSusb,$vendedor);

		if(!is_null($refacciones))
			$refacciones->paginate(5);


		$datos = array(
				'active' 			=> 'index',
				'refacciones'		=> $refacciones,
				'publicacionesId'	=> $id,
				'busqueda'			=> 'test'
			
			);

				
		return View::make('/Admin/Vendedor/suggestions')->with('datos',$datos);

	}


	protected function getCategory($category){


		if($category === 'all')
			return Redirect::to('/Vendedor/');

		//$publicaciones 	= $this->publicacion->getAll();
		$user 			= $this->usuario->find(Session::get('User'));
		$vendedor 		= $user->vendedor()->first();
		$ofertas 		= $vendedor->ofertas()->get();

		$suscripciones  = array();
		$ofertasArray 	= array();

			foreach ($vendedor->suscripciones()
							->where('Status','=','1')
						  	->select('Categoria')
						  	->get()
						  	->toArray() as $categoria) {

		 		array_push($suscripciones,$categoria['Categoria']);
		} 	




		foreach ($ofertas as $oferta ) {
			
			array_push($ofertasArray, $oferta->publicacion()->first()->idPublicacion);
		}

		//dd($ofertasArray);


		$publicaciones = $this->publicacion
							  ->getAllBySuscription($suscripciones,$ofertasArray)
							  ->where('Categoria','=',$category)
							  ->paginate(5);


		$datos = array(
			'active' 		=> 'index',
			'publicaciones'	=> $publicaciones,
			'category'		=> $category
		);

		return View::make('/Admin/Vendedor/index')->with('datos',$datos);

	}


	protected function search(){



			$user 			= $this->usuario->find(Session::get('User'));
			$vendedor 		= $user->vendedor()->first();
			$ofertas 		= $vendedor->ofertas()->get();

			$suscripciones  = array();
			$ofertasArray 	= array();

				foreach ($vendedor->suscripciones()
								->where('Status','=','1')
							  	->select('Categoria')
							  	->get()
							  	->toArray() as $categoria) {

			 		array_push($suscripciones,$categoria['Categoria']);
			} 	


			foreach ($ofertas as $oferta ) {
				
				array_push($ofertasArray, $oferta->publicacion()->first()->idPublicacion);
			}


			$contenido 		= 	Request::get('Contenido');

			$id 			= 	$this->publicacion
									 ->getByIdSubscriptions(	$contenido,
																$suscripciones,
																$ofertasArray);

			$refaSusb		= 	$this->publicacion
									 ->getAllBySuscription($suscripciones,$ofertasArray)
									 ->select('Refaccion')
									 ->get()
									 ->toArray();


			$refacciones 	=  	$this->refa
									->getSearchByRefa($contenido,$refaSusb)
									->paginate(5);
									


			//dd($arrayPublicaciones);

			//return Response::json($arrayPublicaciones);

			$datos = array(
				'active' 			=> 'index',
				'refacciones'		=> $refacciones,
				'publicacionesId'	=> $id,
				'busqueda'			=> $contenido
			
			);

				
			return View::make('/Admin/Vendedor/search')->with('datos',$datos);

		
	}


	public function getPayContract(){



			$plan 		= Request::get('Plan');
			$vendedor 	= Session::get('Seller');

			$type 		= Request::get('Type');



			if(		$plan === 'Mes'){
				
				$precio 	=  400;
				$intervalo	= 'P1M';


			}
				
			else if($plan === 'Anual'){
				
				$precio 	= 3990;
				$intervalo	= 'P1Y';
			}

			else if($plan === 'Semestral'){
				
				$precio 	= 2000;
				$intervalo	= 'P6M';
			}
				
			$cliente  	= $this->cliente->getBySeller($vendedor);

			if(is_null($cliente))
				$cliente	= $this->cliente->newClient($vendedor);
			
			

			$fecha 		= new \DateTime(date("Y-m-d"));

			$intervalo 	= new \DateInterval($intervalo);

			$fin 		= $fecha->add($intervalo);

			//Consultamos si existe el contrato o si esta vencido

			$contrato 	= $cliente->contrato()->first();

			if(is_null($contrato)){

				$contrato 	= $this->contrato->newContract($cliente->idClientes,$fin,$plan);
			}
			else{

				$contrato->Status 	= 	1;
				$contrato->Fin 		=	$fin;	
				$contrato->save(); 
			}


			//Creamos la sesion de contrato para mostrar los datos al final
			Session::put('Contrato',$contrato->idContrato);

			$data  = array(

				'Precio'		=> $precio * 100,
				'Descripcion'	=> 'Pago de plan '.$plan.' del Vendedor '.$vendedor,
				'Referencia'	=> $contrato->idContrato.'/'.$cliente->idClientes,
			);

			if($type === 'Card')
				$data['Token'] = Request::get('Token');


			$charge = $this->createCharge($type,$data);
		


			if($type === 'Card'){

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

			}
			else{

				$codigo 		= $charge->payment_method->barcode_url;


				$contrato->Status = 0;

				$contrato->save();

				Session::put('Codigo',$codigo);

				$data['Codigo'] = $codigo;

				$pdf 			= \App::make('dompdf.wrapper');

				$pdf->loadView('/Admin/Vendedor/pdf',$data);

				return $pdf->stream();
			}

				
	
	}

	public function createCharge($type,$array){

		\Conekta::setApiKey('key_w5B9koxHsk7MxCry');

		$charge;


		if ($type === 'Card'){

			$charge 			= \Conekta_Charge::create(array(

				"amount"		=> $array['Precio'],
				"currency"		=> "MXN",
				"description"	=> $array['Descripcion'],
				"reference_id"	=> $array['Referencia'],
				"card"			=> $array['Token']

			));

		}
		else{


			try{
				  
				  $charge = \Conekta_Charge::create(array(
				    "amount"			=> $array['Precio'],
				    "currency"			=> "MXN",
				    "description"		=> $array['Descripcion'],
				    "cash"				=> array(
				      "type"			=>"oxxo",
				      "expires_at"		=>"2018-09-05"

				    ),
				   
				  ));

				}catch (Conekta_Error $e){

				 dd($e->getMessage());
				 //Un error ocurrió al procesar el pago
				}
		}

		return $charge;
	}





	public function saveSeller(){

		$vendedor 	= $this->seller->getByUser(\Session::get('User'));


		if(is_null($vendedor)){

			$seller 	= $this->seller->newSeller(\Session::get('User'));

			Session::put('Seller',$seller->idVendedor);

			$datos['categorias'] 	= $this->categorias->getAll();	 

			return Redirect::to('/Vendedor/perfil');

		}
		
		\Session::put('Seller',$vendedor->idVendedor);

		return Redirect::to('/Vendedor/');
		


	}


	public function showPay(){

		$datos = array(
			'active' 		=> 'index',
		);

		return View::make('/Admin/Vendedor/method')->with('datos',$datos);
	}



	public function getPay(){

		if (Request::ajax()){


			try {


				$oferta 			= $this->oferta->find(Request::get('Oferta'));

				$precio 			= $oferta->Precio * 100;

				$key 				= $oferta->vendedor()->first()->Privada;

				\Conekta::setApiKey($key);


				$charge 			= \Conekta_Charge::create(array(

					"amount"		=> $precio,
					"currency"		=> "MXN",
					"description"	=> "Refacccion para ".$oferta->getPublish()->Nombre,
					"reference_id"	=> $oferta->idOferta,
					"card"			=> Request::get('Token')

				));


			
				if($charge->status === 'paid'){

					$oferta->Estado     = 'B';

					$oferta->Status 	= '4';

					$oferta->save();

					$publicacion 		= $oferta->getPublish();

					$publicacion->Status= '2';

					$publicacion->save();

					$dataBuy 			= array(

											'forma' 		=> 'Pago REFANET',
											'status'		=> 'A',
											'oferta'		=> $oferta->idOferta,
											'publicacion' 	=> $publicacion->idPublicacion
									  ); 

					$compra 			= $this->saveBuy($dataBuy);

					$dataNote = array(

						'Usuario'		=> $oferta->vendedor()->first()->Usuario,

						'Contenido'		=> 'Han realizado el pago por '
											.'<strong>'
											.$publicacion->refaccion()->first()->Nombre
											.'</strong> ',

						'Url'			=> '/Vendedor/Ventas/',

						'Publicacion'	=> $publicacion->idPublicacion

					);

					$this->nota->newNote($dataNote);

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

	public function saveBuy($array){


		$compra = $this->compras->newBuy($array);

		return $compra;

	}


	protected function getData(){


			$usuario 		= 	Session::get('User');

			
			$usuario 		= 	$this->usuario->find($usuario);

			
			$vendedor 		= 	$usuario->vendedor()->first();

			$userName		= 	$usuario->Nombre;

		



			$datos = array(
				'active' 		=> 'index',
				'user'	 		=>	$usuario,
				'userName'		=>	$userName,
			);

			if(!is_null($vendedor)){

				$suscripciones 			=	$vendedor->suscripciones()->where('Status','=','1');
				$datos['suscripciones'] = 	$suscripciones;
			}
			


			View::share('dataUser', $datos);





	}


	public function index(){


		//$publicaciones 	= $this->publicacion->getAll();
		$user 			= $this->usuario->find(Session::get('User'));
		$vendedor 		= $user->vendedor()->first();
		$ofertas 		= $vendedor->ofertas()->get();

		$suscripciones  = array();
		$ofertasArray 	= array();

			foreach ($vendedor->suscripciones()
							->where('Status','=','1')
						  	->select('Categoria')
						  	->get()
						  	->toArray() as $categoria) {

		 		array_push($suscripciones,$categoria['Categoria']);
		} 	




		foreach ($ofertas as $oferta ) {
			
			array_push($ofertasArray, $oferta->publicacion()->first()->idPublicacion);
		}

		//dd($ofertasArray);


		$publicaciones = $this->publicacion
							  ->getAllBySuscription($suscripciones,$ofertasArray)
							  ->paginate(5);


		$datos = array(
			'active' 		=> 'index',
			'publicaciones'	=> $publicaciones
		);

		return View::make('/Admin/Vendedor/index')->with('datos',$datos);
	}

	
	public function showPart($pieza){


		$publicacion =  $this->publicacion->find($pieza);


		$datos = array(
			'active' => 'index',
			'pieza'	 => $publicacion
		);
		return View::make('/Admin/Vendedor/pieza')->with('datos',$datos);
	}




	public function editOffer($offer){

		if(!$this->oferta->verifyOffer($offer,\Session::get('Seller')))
			return '404';

		$oferta 	 =  $this->oferta->find($offer);

		$publicacion =  $oferta->getPublish();


		$datos = array(
			'active' => 'ofertas',
			'pieza'	 => $publicacion,
			'oferta' => $oferta	
		);

		return View::make('/Admin/Vendedor/pieza')->with('datos',$datos);

	}




	public function showOffers(){


		$vendedor  		= $this->seller->find(Session::get('Seller'));

		$ofertas 		= $vendedor->ofertas()->where('Status','!=','4')->paginate(5);


		$datos = array(
			'active' => 'ofertas',
			'ofertas'=> $ofertas

		);
		return View::make('/Admin/Vendedor/ofertas')->with('datos',$datos);
	}



	public function finish($offer){

		$compra  		= $this->compras->find($offer);

		$oferta 		= $compra->oferta()->first();


		$publicacion 	= $compra->publicacion()->first();



		if(!$this->oferta->verifyOffer($oferta->idOferta,\Session::get('Seller')))
			return '404';

		
		$datos = array(

			'active' 		=> 'ventas',
			'publicacion'	=> $publicacion,
			'oferta'		=> $oferta
		
		);





		return View::make('/Admin/Vendedor/finalizar')->with('datos',$datos);
	}



	public function finishBuy(){


		$compra 		= $this->compras->find(Request::get('compra'));

		if($compra->Status === 'T' )
			$compra->Status = 'F';

		else
			$compra->Status = 'C';


		$compra->save();



		$dataRepu =  array(

			'Usuario'		=> 	$compra->publicacion()
										->first()
										->Usuario,
			'Vendedor'		=>	\Session::get('Seller'),
			'Calificacion'	=>	Request::get('Calificacion'),
			'Comentario'	=>	Request::get('Comentario')
		);

		$rate = $this->reputacion->newRate($dataRepu);

		return Redirect::to('/Vendedor/Ventas');

		
		

	}




	public function post($post){


		if(!$this->oferta->verifyOffer($post,\Session::get('Seller')))
			return '404';


		$oferta 		= $this->oferta->find($post);

		$publicacion 	= $oferta->getPublish();


		if($publicacion->notas()->count() > 0 ){

			foreach ($publicacion->notas()->get() as $nota) {
				
				if($nota->Usuario === Session::get('User')){

					$nota->Status = '2';
					$nota->save();
				}
					 

			}
		}


		$datos = array(

			'active' 	=> 'ofertas',
			'post' 		=> $publicacion,
			'oferta'	=> $oferta,
			'galeria'	=> $this->galeria
								->getAll()
								->where('Refaccion','=',$publicacion->refaccion()
																	->first()
																	->idRefaccion)
		);


		return View::make('/Admin/Vendedor/post')->with('datos',$datos);
	}



	public function acept($post){

		if(!$this->oferta->verifyOffer($post,\Session::get('Seller')))
			return '404';

		$oferta 		= $this->oferta->find($post);


		$datos = array(
			'active' 	=> 'ofertas',
			'oferta' 	=> $oferta 
		);

		return View::make('/Admin/Vendedor/aceptar')->with('datos',$datos);
	}



	public function complete($post){

		if(!$this->oferta->verifyOffer($post,\Session::get('Seller')))
			return '404';

		$oferta 		= $this->oferta->find($post);

		$oferta->Status = '4';

		$oferta->save();

		$compra 		= $oferta->compra()->first();

		$compra->Status = 'R';

		$compra->save();


		$dataNote = array(

			'Usuario'		=> $compra->publicacion()
										->first()
										->Usuario,

			'Contenido'		=> '<strong>'
								.$compra->publicacion()
										->first()
										->refaccion()
										->first()
										->Nombre
								.'</strong> han aceptado la compra',

			'Url'			=> '/Comprador/Publicacion/'.$compra->publicacion()
																->first()
																->idPublicacion,

			'Publicacion'	=> $compra->publicacion()
									->first()
									->idPublicacion,

		);

		$this->nota->newNote($dataNote);



		return Redirect::to('/Vendedor/Ventas');
		
	}




	public function ventas(){


		$ofertas = $this->oferta->getAllByUser(\Session::get('Seller'))
								->whereBetween('Status', [3,4])
								->orderBy('idOferta','DESC')
								->paginate(5);	

		foreach ($ofertas as $oferta) {

			if($oferta->publicacion()->first()->notas()->count() > 0 ){

				foreach ($oferta->publicacion()->first()->notas()->get() as $nota) {
					
					if($nota->Usuario === Session::get('User')){

						$nota->Status = '2';
						$nota->save();
					}
						 

				}
			}

		}

	


		$datos = array(
			'active' => 'ventas',
			'ofertas'=> $ofertas
		);

		return View::make('/Admin/Vendedor/ventas')->with('datos',$datos);
	}


	public function setConekta(){


		$seller =  $this->seller->setConekta(Request::all());

		return Redirect::to('/Vendedor/perfil');
	}



	public function listaSoporte(){


		$datos = array(
			'active' => 'soporte',
			'ticket' =>  $this->ticket->getAllByUser()->paginate(20)
		);
		return View::make('/Admin/Vendedor/listaSoporte')->with('datos',$datos);
	}



	public function soporte(){
		$datos = array(
			'active' => 'soporte'
		);
		return View::make('/Admin/Vendedor/soporte')->with('datos',$datos);
	}


	public function profile(){



		$client     	= $this->cliente->getBySeller(Session::get('Seller'));

		$status 		= true;

		if(!is_null($client)){

			if(is_null($client->contrato()->first())){

				$client =  	null;
				$status =	false;
			}

			elseif($client->contrato()->first()->Status == 2){

				$client =  	null;
				$status =	false;
			}

		}
		

		$vendedor 		= $this->seller->find(Session::get('Seller'));
		$categorias 	= $this->categorias->getAll();

		$suscripciones  = array();
		$ofertasArray 	= array();



		foreach ($vendedor->suscripciones()
					  ->select('Categoria')
					  ->get()
					  ->toArray() as $categoria) {

	 		array_push($suscripciones,$categoria['Categoria']);
		} 	



		$datos = array(
			'active' 		=> 'index',
			'cliente'		=> $client,
			'vendedor'		=> $vendedor,
			'categorias'	=> $categorias,
			'status'		=> $status

		);


		return View::make('/Admin/Vendedor/profile')->with('datos',$datos);
	}



	public function setOffer(){


		if (Request::ajax()){


			$categoria 		= $this->categorias->find(Input::get('Categoria'));
			$usuario 		= $this->usuario->find(Session::get('User'));
			$publicacion 	= $this->publicacion->find(Input::get('Publicacion'));


			$data = array(

					'Nombre'		=> 'Refaccion',
					'Tipo'			=> 'Conocido',
					'Marca'			=> 'Conocida',
					'Modelo'		=> 'Conocido',
					'Categoria'		=> $categoria->idCategoria,
					'Marca'			=> 1,
					'Descripcion'	=> Input::get('Detalles')

				);

			$newRefa = $this->refa->nuevaRefaccion($data);


			$path =  public_path().'/images/Usuarios/'.$usuario->Mail.'/';


			foreach ($_FILES as $key) {

				$name = $key['name'];

				move_uploaded_file($key['tmp_name'], $path.$name);

				$photo = array(
					'nombre' 	=> 	$name,
					'path' 		=>	'/images/Usuarios/'.$usuario->Mail.'/'.$name,
					'refa'		=>  $newRefa->idRefaccion,
				);

				$galery =  $this->galeria->newPhoto($photo);

			}

			$data  					= Request::all();
			$data['Refaccion'] 		= $newRefa->idRefaccion;
			
			$oferta = $this->oferta->newOffer($data);

			$dataNote = array(

				'Usuario'		=> $publicacion->Usuario,
				'Contenido'		=> '<strong>'.$publicacion->refaccion()->first()->Nombre.'</strong> ha recibido una oferta',
				'Url'			=> '/Comprador/Publicacion/'.$publicacion->idPublicacion,
				'Publicacion'	=> $publicacion->idPublicacion

			);

			$this->nota->newNote($dataNote);

			return array('ok'=>true);	

			
		}
	}




	public function saveEditOffer(){


		if (Request::ajax()){


		

			if(!$this->oferta->verifyOffer(Request::get('oferta'),\Session::get('Seller')))
				return '404';

				
				$usuario 		= $this->usuario->find(Session::get('User'));

				$this->oferta->modifyOffer(Request::all(),Request::get('oferta'));

				$offer 		= $this->oferta->find(Request::get('oferta'));



				$refaccion = $offer->refaccion()->first();

				//Guardamos la ediciones
				$refaccion->Descripcion = Request::get('description');

				$refaccion->save();

				$path =  public_path().'/images/Usuarios/'.$usuario->Mail.'/';

				foreach ($_FILES as $key) {
					//dd(1);
					$name = $key['name'];

					move_uploaded_file($key['tmp_name'], $path.$name);

					$photo = array(
						'nombre' 	=> 	$name,
						'path' 		=>	'/images/Usuarios/'.$usuario->Mail.'/'.$name,
						'refa'		=>  $refaccion->idRefaccion,
					);

					$galery =  $this->galeria->newPhoto($photo);
	
				}

				//Eliminamos las imagenes que fueron removidas
				$this->galeria->removePhoto(explode(',',Input::get('deletedImg')));


			
			return array('ok'=>true);	

			
		}

	}
	

	public function getProfile($perfil){
		
		
		
			$vendedor 		= 	$this->seller->find($perfil);

			

			$calificacion 	=	$vendedor->reputacion()->avg('Calificacion');


			$comments 		= array();


			foreach ($vendedor->reputacion()->limit(5)->get() as $repo) {
				

				 array_push($comments, $repo->Comentario);
			}

			$data = array(

				'Calificacion' 	=>  round($calificacion, 0, PHP_ROUND_HALF_UP),
				'Comentarios'  	=>	$comments,
				'Vendedor'	 	=>	$vendedor->usuario()->Select('Nombre','Avatar')->first()
			);

			return Response::json($data);

		
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


				return Redirect::to('/Vendedor/Soporte');

		}


	}



	public function getTicket($ticket){


		$ticket =  $this->ticket->getTicketByUser($ticket);

		//dd($ticket->Asunto);

		$datos = array(
			'active' => 'soporte',
			'ticket' => $ticket
		);
		return View::make('/Admin/Vendedor/ticket')->with('datos',$datos);
	}


	public function makeComment(){

		if (Request::ajax()){

		//	dd(Request::all());

			$comentario = $this->comentario->newComment(Request::all());
			$oferta 	= $this->oferta->find(Request::get('Oferta'));

			$dataNote = array(

				'Usuario'		=> $oferta->publicacion()->first()->Usuario,
				'Contenido'		=> '<strong>'
									.$oferta->publicacion()
											->first()
											->refaccion()
											->first()
											->Nombre
											.'</strong> tiene un nuevo comentario',

				'Url'			=> '/Comprador/Publicacion/'
									.$oferta->publicacion()
											->first()
											->idPublicacion,


				'Publicacion'	=> $oferta->publicacion()
										  ->first()
										  ->idPublicacion

			);

			

			$this->nota->newNote($dataNote);

			$retorno = array(
				'ok' => true
			);

			return Response::json($retorno);
		}
	}




	public function saveProfile(){

		//dd(Request::all());

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

		$suscripciones  = Request::get('marcas');

		

		//Desactivcamos todas las suscripciones para activar las nuevas
		$this->suscripciones->quitById(Session::get('Seller'));

		//Verificamos si existen suscripciones
		if(!is_null($suscripciones)){


			foreach ($suscripciones as $key) {
			
		
				$sus 			=  	explode('/',$key);
				$sus[2]			= 	Session::get('Seller');

				$data = array(

					'Vendedor'	=> Session::get('Seller'),
					'Marca'		=> $sus[1],
					'Categoria'	=> $sus[0]
				); 


				$suscripcion 	= 	$this->suscripciones->getByIds($sus);




				if(is_null($suscripcion)){
	
					$this->suscripciones->newSubscription($data);
				}
					
				else
					$this->suscripciones->updateById($sus);

			}


		}
		

	



		return Redirect::to('/Vendedor/perfil');
	}


	
}
