<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Refanet Administración</title>
	
	<meta name="_token" content="{!! csrf_token() !!}"/>

	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
	

	<style>

		@if(isset($datos))
			#{{$datos['active']}}{
				background: #E56B15;
			}

			#{{$datos['active']}} a:hover,
			#{{$datos['active']}} a{
				color:white !important;
			}
		@endif
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

					<img src="/images/avatars.png" alt="" class='inline vmedio'>

					<h2 class="inline vmedio">Administrador</h2>

				 	<b class="caret white"></b>

				 	<span class="icon-play3 icomoon arrow"></span>
				 	<ul class="subMenu boxShadow ">
						
				 		<li>
				 			<a href="/Comprador/Exit">
				 				Cerrar Sesión
				 			</a>
				 		</li>

				 	</ul>

				</li>

				<!--<li id='changeCategory'>

					<select class="form-control bottom-none">
					      <option>
					      		<a href="">
					      			
					      			Vendedores
					      		</a>
					      		
					      </option>

				      	  <option>
				      	  	Compradores
				      	  </option>
				      
				    </select>
				</li>-->

				<li id='changeProfile'>
					

					<span class="glyphicon glyphicon-signal middleIcon white"></span>

					<span class="icon-play3 icomoon arrow"></span>
				 	<ul class="subMenu boxShadow ">
						
				 		<li>
				 			<a href="/Administrador/graficas">
				 				De Ventas
				 			</a>

				 		</li>

				 	</ul>


				</li>


				

				<!--<li id='notes'  role="presentation" class="btn-group select select-block">
						
					<!-- notificaciones-->
					<!--<span class="icon-bell icomoon middleIcon white inline vmedio"></span>
					<span class="icon-play3 icomoon inline vmedio nota fgazul"></span>
					<span class="textNote">15</span>

					<span class="icon-play3 icomoon arrow"></span>
					<ul class="subMenu">


						<div id='listNotes'>
							<li>uno</li>
							<li>uno</li>
							<li>uno</li>
							<li>uno</li>
						</div>
						<li id='static'>
							Ver Todo
						</li>

					</ul>

					
				</li>	-->

			

			</ul>
		</nav>
	</header>


</div>

@yield('pre-content')




	<section class='contentCenter' id='subNav'>

		<ul class='list-none'>
			<li id='index'>
				<a href="/Administrador" title="">
					<span class='glyphicon glyphicon-user'></span>
					Clientes
				</a>
			</li>

			<li id='categorias'>
				<a href="/Administrador/Categorias" title="">
					<span class='glyphicon glyphicon-th'></span>
					Categorías
				</a>
			</li>

			<li  id='marcas'>
				<a href="/Administrador/Marcas" title="">
					<span class='glyphicon glyphicon-tags'></span>
					Marcas
				</a>
			</li>

		
			
			<li id='soporte'>
				<a href="/Administrador/Soporte" title="">
					<span class='glyphicon glyphicon-wrench'></span>
					Tickets
				</a>
			</li>

			<li class='search'>
				<div class="form-search search-only" style='position:relative'>
	                {!! Form::open(array(	'url' => '/Administrador/busqueda',
											'id'=>'searchForm', 
											'method'=>'POST')) !!}
				
	                   <input 	type		=	"search" 
	                   			class		=	"form-control" 
	                   			id			=	"search"
	                   			name 		= 	'Cliente'
	                   			required	 
	                   			placeholder	=	'Buscar cliente' >

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
 				<li><span class="icon-facebook icomoon"></span></li>
 				<li> <span class="icon-twitter"></span></li>
 				<li>
 					<span class="icon-googleplus"></span>
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

{!! HTML::script('/js/vendors/Chart.js')!!}



@yield('scripts')
	
</body>
</html>