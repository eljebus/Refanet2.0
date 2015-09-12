<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Refanet</title>
	
	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
	<meta name="_token" content="{{ csrf_token() }}"/>



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
					<a href="/" title="REFANET">
						<img src="/images/refanet.png" alt="Refanet" class='inline vmedio'>
						<h1 class='inline vmedio'>REFANET </h1> 
						<small class='inline vmedio white'> -
						<i id='category'>{{ Session::get('categoria') }}</i></small>
					</a>
				</li>

				<li>
					<a href="" title="">

						¿Cómo Funciona?
					</a>
				</li>

				<li id='refa'>
					<a href="/Registro/Comprador/inicio" title="Mi refacción">

						Mi Refacción

					</a>
				</li>
				
				<li id='login' class='white'>
					
						<span class="vmedio inline"  data-toggle="modal" data-target="#loginModal">
							Ingresar
						</span>
						<span class="glyphicon glyphicon-user inline vmedio"></span>

				</li>	

			</ul>
		</nav>
	</header>


</div>

@yield('pre-content')




	<div id='contentContainer'>

		@yield('content')

		
		

	</div>




<div id="inferior">
 	
 	<footer>
 		
 		<ul class="list-none inline">

 			<li>¿Cómo Funciona?</li>
 			<li>
 				<a href="/Registro/Comprador/inicio">
 					Mi Refacción	
 				</a>
 				
 			</li>
 			<li>
 				
				<span class="vmedio inline"  data-toggle="modal" data-target="#loginModal">
					Ingresar
				</span>

 			</li>
 			<li>
 				<a href="/Registro/Vendedor/inicio">
	 				Registrarse
	 			</a>
 			</li>
 		</ul>


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
		<article id='lema'>
			
			<img src="/images/refanetDown.png">
			<p>
				La mejor plataforma de venta de refacciones
				<br>
				<small> Refanet 2014 todos los derechos reservados</small>
			</p>

		</article>	

 	</footer>

</div>





<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="loginModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title fontNormal middle smallTitles" id="myModalLabel">Ingresa tus datos</h5>
      </div>
      <div class="modal-body">

      		<button type="button" class="btn btn-primary btn-block fontNormal" id='faceLogin'>
				<span class="icon-facebook icomoon"></span> Facebook Login
			</button>

			<p class='center'><center>Ó</center></p>
		
       		
      		{!! Form::open(array('id'=>'loginForm')) !!}
				

      			<div class="errorMassage fontNormal"></div>

      			<div class="form-group">
	              <input 	type="text" 
	              			class="form-control login-field fontNormal" 
	              			value="" 
	              			placeholder="Mail" 
	              			id="login-name" 
	              			name = 'mail' 
	              			required>
	            </div>
	            <div class="form-group">
	              <input type="password" class="form-control login-field fontNormal" value="" placeholder="Contraseña" id="login-name" name = 'clave' required>
	            </div>

	            <button type="submit" class="btn btn-success btn-block fontNormal">Ingresar a REFANET</button>
	   

      		{!! Form::close() !!}


      </div>

    </div>
  </div>
</div>


{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')!!}
{!! HTML::script('/vendors/js/bootstrap.min.js')!!}
{!! HTML::script('/js/login.js')!!}




@yield('scripts')
	
</body>
</html>