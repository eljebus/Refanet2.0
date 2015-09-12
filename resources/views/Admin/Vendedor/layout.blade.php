<!DOCTYPE htm!!>
<html>
<head>
	<meta charset="utf-8">
	<meta lang='es'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Refanet</title>

	<meta name="_token" content="{!! csrf_token() !!}"/>

	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>

	<style>
		#{{$datos['active']}}{
			background: #E56B15;
		}

		#{{$datos['active']}} a:hover,
		#{{$datos['active']}} a{
			color:white !important;
		}
	</style>
	


	@yield('styles')


</head>
<body>
<div id="superior">
	<div id="line">

	</div>
	<header>
		<nav>
			<ul class='list-none'>
				<li id='logo'>
					<a href="/" title="">
						<img src="/images/refanet.png" alt="Refanet" class='inline vmedio'>
						<h1 class='inline vmedio'>REFANET</h1>
					</a>
				</li>

			
				
				<li id='profile' role="presentation" class="btn-group select select-block">

					<img src="{{$dataUser['user']->Avatar}}" alt="" class='inline vmedio'>

					<h2 class="inline vmedio">{{$dataUser['user']->Nombre}}</h2>

				 	<b class="caret white"></b>

				 	<span class="icon-play3 icomoon arrow"></span>
				 	<ul class="subMenu boxShadow ">

				 		<li>
				 			<a href="/Vendedor/perfil">
					 			Mi Cuenta
					 		</a>
				 		</li>
				 		<li>
				 			<a href="/Comprador/Exit" title='Salir'>
					 			Cerrar Sesión
					 		</a>
				 		</li>

				 	</ul>

				</li>

				<li id='changeCategory'>

					<select class="form-control bottom-none" id='category'>

						<option value="all">Todas</option>

				     @foreach($dataUser['suscripciones']->get() as $suscripcion)

				     	<?php

								$selected = '';

								if(array_key_exists('category',$datos)){

									//dd($datos['category']);

									if(intval($datos['category']) === $suscripcion->categoria()
																				->first()
																				->idCategoria)
										$selected = 'selected';
								}
							?>



				     	<option value="{{$suscripcion->Categoria}}" {{$selected}}>
				     		{{$suscripcion->categoria()->first()->Nombre}}
				     	</option>


				     @endforeach

				    </select>
				</li>

				<li id='changeProfile'>

					<span class="icon-users middleIcon white"></span>

					<span class="icon-play3 icomoon arrow"></span>
					<ul class="subMenu">

						<li>
							<a href="/Comprador">
								Comprar
							</a>
						</li>


					</ul>

				</li>


				

				<li id='notes'  role="presentation" class="btn-group select select-block">
						
					<!-- notificaciones-->

					

					<span class="icon-bell icomoon middleIcon white inline vmedio"></span>

					<div id='notas'>


						@if($dataUser['user']->notas()
											 ->where('Status','=','1')
											 ->count() > 0)
							
							<span class="icon-play3 icomoon inline vmedio nota fgazul"></span>
							<span class="textNote">{{$dataUser['user']->notas()
																	  ->where('Status','=','1')
																	  ->count()}}</span>

						@endif

						
					</div>
					
					<span class="icon-play3 icomoon arrow"></span>
					<ul class="subMenu">


						<div id='listNotes'>

							@if($dataUser['user']->notas()
											 ->where('Status','=','1')
											 ->count() > 0)

								@foreach($dataUser['user']->notas()
													  ->where('Status','=','1')
													  ->orderBy('idNotificaciones','DESC')
														  ->get() as $nota)
									<a href="{{$nota->Url}}" title="{{$nota->Contenido}}">
										<li>
											{!!$nota->Contenido!!}
										</li>
									</a>
								@endforeach

							
							@else
								<li>
									Aun no tienes notificaciones									
								</li>
							@endif
							
						</div>
						<li id='static'>
							Mis notificaciones
						</li>

					</ul>

					
				</li>

				<li id='rocket'>
					<a href="/Vendedor/Sugerencias" title='Sugerencias Refanet'>
						<span class=" middleIcon white inline vmedio icon-rocket" ></span>
					</a>
				</li>


			

			</ul>
		</nav>
	</header>


</div>

@yield('pre-content')




	<section class='contentCenter' id='subNav'>

		<ul class='list-none'>
			<li id='index'>
				<a href="/Vendedor" title="">
					<span class='glyphicon glyphicon-volume-up'></span>
					Lo Nuevo
				</a>
			</li>

			<li  id='ofertas'>
				<a href="/Vendedor/Ofertas" title="">
					<span class='glyphicon glyphicon-credit-card'></span>
					Mis Ofertas
				</a>
			</li>

			<li id='ventas'>
				<a href="/Vendedor/Ventas" title="">
					<span class='icon-tags icomoon'></span>
					Mis ventas
				</a>
			</li>

			<li id='soporte'>
				<a href="/Vendedor/Soporte" title="">
					<span class='glyphicon glyphicon-wrench'></span>
					Soporte
				</a>
			</li>

			<li class='search'>

				<div class="form-search search-only" style='position:relative'>
                 {!! Form::open(array(	'url' => '/Vendedor/busqueda',
										'id'=>'searchForm', 
										'method'=>'POST')) !!}
			
                   <input 	type		=	"search" 
                   			class		=	"form-control" 
                   			id			=	"search"
                   			name 		= 	'Contenido' 
                   			placeholder	=	'Buscar Publicación' >

                  <span class="glyphicon glyphicon-search form-control-feedback"></span>

                {!! Form::close() !!}
                </div>
			</li>


		</ul>
		
	</section>

	<div id='contentContainer'>

		@yield('content')

		


		

	</div>




<div id="inferior">
 	
 	<footer>

 		<div id='redes' class='inline vmedio'>

 			<ul class="list-none fontNormal">
 				
 				<li class='text'> Siguenos</li>
 					<li>
 					<a href=" https://www.facebook.com/facerefanet">
 						
 							<span class="icon-facebook icomoon"></span>
 					</a>
 				
 				</li>
 				<li> 
 					<a href="https://twitter.com/RefanetApp">
 						
 						<span class="icon-twitter"></span>
 					</a>
 					
 				</li>
 				<li>
 					<a href="ttps://plus.google.com/u/0/112839204178640197971/posts">
 						
 						<span class="icon-googleplus"></span>
 					</a>
 					
 				</li>


 			</ul>
 			
 		</div>


 	</footer>

 	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id='errorModal'>
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h5 class="modal-title fontNormal middle smallTitles" id="imageLabel">
		        	<span class="glyphicon glyphicon-exclamation-sign rojo"></span> Ocurrió un error

		        </h5>
		    </div>

		    <div class="modal-body fontNormal" id="errorMessageModal">
		    </div>

	    </div>
	  </div>
	</div>

</div>

{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')!!}
{!! HTML::script('/vendors/js/bootstrap.min.js')!!}
{!! HTML::script('/js/vendors/error.js')!!}
{!! HTML::script('/js/Vendedor/search.js')!!}



@yield('scripts')
	
</body>
</html>