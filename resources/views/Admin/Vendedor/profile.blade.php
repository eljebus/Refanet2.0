@extends('Admin/Vendedor/layout')


@section('styles')
		
	
		{!! HTML::style('/css/Admin/Vendedor/perfil.css') !!}

		<style>
			#contentContainer #registerForm{
				border:none;
			}
			#profileForm{

				font-family: "Lato",Helvetica,Arial,sans-serif;
			}
		</style>

@stop


@section('pre-content')
	
	<section class='contentCenter' id='subNavNew'>

		<ul class='list-none'>
			<li id='index'>
				<a href="/Vendedor/perfil" title="">
					<span class='glyphicon glyphicon-user'></span>
					Mi Cuenta
				</a>
			</li>


			<li id='soporte'>
				<a href="/Vendedor" title="">
					<span class="glyphicon glyphicon-volume-up"></span>
					Lo Nuevo
				</a>
			</li>

			<li class='search'>

				<div class="form-group">
		        	<input 	type		="text" 
		        			value		="" 
		        			placeholder	="Buscar Publicación" 
		        			class		="form-control">
		        
	        	</div>
			</li>


		</ul>
		
	</section>
	
@stop


@section('content')



	{!! Form::open(array(	'id'	=>	'profileForm',
							'method'=>	'POST',
							'url'	=> 	'/Vendedor/saveProfile',
							'class'	=>	'contentCenter',
							'files'	=>	true)) !!}

	<div id='profileFormContainer'>

		<div class="izquierda floatLeft">
			
			<div class="input-group perfil">
	          <span class="input-group-addon">
	          	<span class="glyphicon glyphicon-user"></span>
	          </span>
	          <input 	type		=	"text" 
	          			class		=	"form-control" 
	          			placeholder	=	'Nombre Completo' 
	          			value		=	"{{$dataUser['userName']}}" 
	          			name		=	'Nombre' required>
	        </div>


			<div class="form-group">

				<input 	type		="password" 
						class		="form-control login-field"  
						placeholder	="Nuevo password" 
						id			="login-name" 
						value		="valor de prueba" 
						name='Clave'>


				<input type="hidden" name='vendedor' value='true'>


				<select class="form-control inline doble" name='Estado'>

					@if($dataUser['user']->Estado != '')
						<option value="{{$dataUser['user']->Estado}}" selected>
							{{$dataUser['user']->Estado}}
						</option>
					@endif
					
					<option value="Aguascalientes">Aguascalientes</option>
					<option value="Baja California">Baja California</option>
					<option value="Baja California Sur">Baja California Sur</option>
					<option value="Campeche">Campeche</option>
					<option value="Chiapas">Chiapas</option>
					<option value="Chihuahua">Chihuahua</option>
					<option value="Coahuila">Coahuila</option>
					<option value="Colima">Colima</option>
					<option value="Distrito Federal">Distrito Federal</option>
					<option value="Durango">Durango</option>
					<option value="Estado de México">Estado de México</option>
					<option value="Guanajuato">Guanajuato</option>
					<option value="Guerrero">Guerrero</option>
					<option value="Hidalgo">Hidalgo</option>
					<option value="Jalisco">Jalisco</option>
					<option value="Michoacán">Michoacán</option>
					<option value="Morelos">Morelos</option>
					<option value="Nayarit">Nayarit</option>
					<option value="Nuevo León">Nuevo León</option>
					<option value="Oaxaca">Oaxaca</option>
					<option value="Puebla">Puebla</option>
					<option value="Querétaro">Querétaro</option>
					<option value="Quintana Roo">Quintana Roo</option>
					<option value="San Luis Potosí">San Luis Potosí</option>
					<option value="Sinaloa">Sinaloa</option>
					<option value="Sonora">Sonora</option>
					<option value="Tabasco">Tabasco</option>
					<option value="Tamaulipas">Tamaulipas</option>
					<option value="Tlaxcala">Tlaxcala</option>
					<option value="Veracruz">Veracruz</option>
					<option value="Yucatán">Yucatán</option>
					<option value="Zacatecas">Zacatecas</option>
				</select>

				<input type="text" class="form-control inline doble ultimo" value="{{$dataUser['user']->Municipio}}" placeholder="Municipio" name='Municipio' >


				<input 	type="text" 
						class="form-control login-field" 
						value="{{$dataUser['user']->Domicilio}} " 
						placeholder="Dirección" 
						name='Domicilio'  >

				<input 	type="text" 
						class="form-control inline doble" 
						value="{{$dataUser['user']->CP}}" 
						placeholder="Codigo Postal" 
						name='Cp' >

				<input 	type="tel" 
						class="form-control inline doble ultimo" 
						value="{{$dataUser['user']->Tel}}" 
						placeholder="telefono" 
						name='Telefono'>

				<input 	type="email" 
						class="form-control " 
						value="{{$dataUser['user']->Mail}}" 
						placeholder="Correo Electónico" 
						name='Mail' 
						required>


	


	    	</div>

		</div>

		<div class="derecha floatRight">
			<div class="form-group">
				<img src="{{$dataUser['user']->Avatar}}" id='avatar'>

				<div id="imagen" class='verde'>

					Cambiar Foto de Perfil

					<input 	type="file" class="form-control " 
							value="jesuscervantes82@hotmail.com" 
							name='avatar' 
							id='avatarInput'>

				</div>	
			</div>

			@if(array_key_exists('cliente',$datos) && !is_null($datos['cliente']))

					

					Plan: 
						<strong>
							{{$datos['cliente']->contrato()->first()->Tipo}}
						</strong>
						<br>
					Inicio:
						<strong>
							{{$datos['cliente']->contrato()->first()->Inicio}}
						</strong>
						<br>
					Próximo Pago:
						<strong>
							{{$datos['cliente']->contrato()->first()->Fin}}
						</strong>
						<br>
					@if($datos['cliente']->contrato()->first()->Status === 0)
						<br>
						<strong>
							
							Pendiente de Pago
						</strong>
						

					@endif

			@else
				<center>
					Aun no tienes una cuenta activa o tu cuenta caducó
					<a href='/Vendedor/Metodo' class="btn btn-success btn-block" id='save'>
						Activar mi cuenta
			   		 </a>

				</center>
				
			@endif
		</div>

	</div>



	<div id='reputacion'>
		
		<h3>Reputación</h3>

		<div id="note">

			<?php $calificacion =   round($dataUser['user']->vendedor()
														   ->first()
														   ->reputacion()
														   ->avg('Calificacion'), 0, PHP_ROUND_HALF_UP); ?>

			@for($i=1;$i <=$calificacion;$i++)

  				<span class="glyphicon glyphicon-star inline goodNote"></span>
  		
  			@endfor

  			@for($i=1;$i <=(5 - $calificacion);$i++)

				<span class="glyphicon glyphicon-star inline"></span>

  			@endfor
  		</div>
		
		<br>

		<p>Últimos comentarios</p>

  		<ul class="list-group">

	  		@foreach($dataUser['user']->vendedor()
									  ->first()
									  ->reputacion()
									  ->orderBy('id','DESC')
	  								  ->limit(5)
	  								  ->get() as $comentario)

			  <li class="list-group-item">

			  	{{$comentario->Comentario}}

			  </li>
	
			
			@endforeach


		</ul>



	</div>
	<br>
	<br>


	<section id="registerForm" >

			<article class='fontNormal textBold'>

				Selecciona las acategorías para que recibas notificaciones y alertas en tu panel y tu correo, así como también las marcas que puedes vender 
				<small class='textNormal'>
					<i>(Selecciona al menos una categoria y una marca)</i>
				</small>
				
			</article>

			<div id="suscriptionForm">


				<div id='divContainer'>
					<div class="floatLeft categorys">

						<h3 class="fontNormal bigTitles orange">Categorías</h3>
						<br>
						<ul class="list-none checkboxList">
			
							@foreach( $datos['categorias']->get() as $categoria )

								<?php $bandera = ''; ?>


								@foreach( $datos['vendedor']->suscripciones()
															->where('Status','=','1')
															->get()
						  									as $catCliente)



						  			@if( $categoria->Nombre === $catCliente->categoria()->first()->Nombre ) 
										<?php $bandera = 'checked'; ?>
						  			@endif


						  		@endforeach

										<li>
											
											<input 	type 	= "checkbox"  
													class 	= 'checkCategory' 
													name 	= "categorias[]" 
													id 		= '{{$categoria->idCategoria}}' 
													value 	= "{{$categoria->idCategoria}}"
													data-id = "{{$categoria->idCategoria}}"
													data-n 	= "{{$categoria->Nombre}}"
													{{$bandera}}>


											<label for='{{$categoria->idCategoria}}'> {{$categoria->Nombre}}</label>

										</li>

								

								

							@endforeach
							
						
					</div>
					<div class="floatRight marks">

						<h3 class="fontNormal bigTitles orange">Marcas</h3>
						<br>
						<ul class="list-none checkboxList" id='marcas'>

							@foreach( $datos['vendedor']->suscripciones()
														->where('Status','=','1')
														->get()
					  									as $catCliente)

								<?php  $marca =  $catCliente->marca()->first() ?>
								<?php  $cat   =  $catCliente->categoria()->first() ?>
					
								<li id="{{$marca->idMarca}}{{$cat->idCategoria}}">

									<input 	type="checkbox" 
											id="{{$marca->idMarca}}{{$cat->idCategoria}}M" 
											name="marcas[]" 
											value="{{$cat->idCategoria}}/{{$marca->idMarca}}"
											checked>
									<label for="{{$marca->idMarca}}{{$cat->idCategoria}}M"> 
										{{$cat->Nombre}}/{{$marca->Nombre}}
									</label>


								</li>




					  		@endforeach
							
							@if($datos['vendedor']->suscripciones()
													->where('Status','=','1')
													->count() === 0)

								<p id='relleno'>
									
									Selecciona una categoría
								</p>

							@endif
							
						</ul>

							 
					
					</div>


					
				</div>
				
				<button type="submit" class="btn btn-success btn-block" id='save'>
					Guardar Cambios
		   		 </button>

				
			{!! Form::close() !!}

			</div>


		</section>


	<section id="conekta" >

		<h2 class="bigTitles orange">Pago REFANET</h2>

		<article class="well">

			En REFANET utilizamos la plataforma de pago CONEKTA.
			<br>
			<p>
				Conekta es una empresa mexicana de software con sede en la Ciudad de México que opera conekta.mx, una búsqueda y revisión de usuario del sitio web local en México. Conekta tiene actualmente alrededor de 1,2 millones de empresas mexicanas en su base de datos.

			</p>
			<p>
				Comienza a procesar pagos con tarjetas de crédito, tarjetas de débito y pagos con efectivo en supermercados y bancos.
			</p>
			
			<p>
				Conekta ofrece un producto sólido que garantiza todo lo que necesitas para procesar pagos: recibir notificaciones de pago al momento, recibir depósitos a tiempo y asegurar el mayor número de pagos exitosos.
			</p>
			

			
		</article>
		<a 	href='https://www.conekta.io/es'
			class="btn btn-info" 
			target='_blank'>
			Crear Cuenta 
		</a>

		{!! Form::open(array('id'=>'conektaForm','method'=>'POST','url'=>'/Vendedor/setConekta')) !!}

			
	

			<input 	type="text" 
					class="form-control inline doble inline" 
					name='Privada'
					placeholder="Llave Privada" 
					value="{{$dataUser['user']->vendedor()
									  ->first()
									  ->Privada}}" 
					required>


			<input type="text" 
					class="form-control login-field doble ultimo inline" 
					name='Publica'
					placeholder="Llave Publica"  
					value="{{$dataUser['user']->vendedor()
									  ->first()
									  ->Publica}}"
					required>
			<br>
			<br>
			<button type="submit" class="btn btn-success btn-block">
				Guardar llaves
		    </button>

		</div>

		{!! Form::close() !!}


	</section>
	<br>
	<br>


		
				
	
@stop

@section('scripts')
	
	{!! HTML::script('/js/Comprador/avatar.js')!!}

	<script>

	$(document).on('ready',iniciar);


	function iniciar(){

		$('.checkCategory').on('change',showMarks);

	}	



	function showMarks(){

		var bandera = false;

		var id 		= $(this).data('id');
		var name 	= $(this).data('n');


		 if(this.checked) 
		 	bandera = true;

		  $.ajax({

		       url : '/getMarcks/' + id,
		       type : 'GET',
		       headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
		       processData : false, 
		       contentType : false, 
		       success : function(res){
		       	
		         	showMarcks(bandera,
		         				res,
		         				id,
		         				name);
			        
			     }

		    });

	}


	function showMarcks(bandera,marcas,id,name){

			if(bandera === true){

				$('#relleno').remove();

				for ( marca in marcas){
			         	
			         	
			         $('#marcas').append("<li id='"+marcas[marca]['idMarca']+id+"'><input type='checkbox' id='"+marcas[marca]['idMarca']+id+"M' name='marcas[]' value='"+id+"/"+marcas[marca]['idMarca']+"'><label for='"+marcas[marca]['idMarca']+id+"M'> "+name+"/"+marcas[marca]['Nombre']+"</label></li>");
			    }

			}
			else{

				for ( marca in marcas){
			         	
			         	console.log('#'+marcas[marca]['idMarca']+id);
			         	
			         $('#marcas').find('#'+marcas[marca]['idMarca']+id).remove();
			    }

			}
			 


	}
	

</script>



@stop