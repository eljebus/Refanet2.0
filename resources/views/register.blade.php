@extends('layout')


@section('styles')

		{!! HTML::style('/css/registro.css') !!}

@stop


@section('pre-content')



	
@stop


@section('content')

		<div class='bg-gray'>
			<ul class='list-none contentCenter' id='etapas'>
			<li class='ItemActive'>

					<span class="itemCircle bg-blue white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Registrarme</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Detalles de la Pieza</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">3</span>
					<p class='inline vmedio bottom-none'>Publicar Refacción</p>

				</li>

			</ul>
			
		</div>

	

		<section id="registerForm" class='contentCenter'>
			{!! Form::open(array('url' => 'Registro/Comprador/Detalles','id'=>'contactForm','method'=>'POST')) !!}

				<button type="button" class="btn btn-primary btn-block removeFb fontNormal" id='fblogin'>
					<span class="icon-facebook icomoon"></span> Ingresa con Facebook
				</button>

				<div class="infoMassage">
				</div>
		
				<p class='center removeFb' style='text-align:center;margin-top:1em'>Ó</p>

				<div class="errorMassage">

				</div>
			
				<div class="form-group">
	              <input type="text" class="form-control login-field" value="" name='name' placeholder="Nombre Completo" id="login-name" required>
	            </div>

	            <div class="form-group">
	              <input type="email" class="form-control login-field" value="" name='mail' placeholder="Correo Electrónico" id="login-name" required>
	            </div>

	            <div class="form-group">
	            	<span id='aviso' class='fontNormal litleText'></span>

	              <input type="password" class="form-control login-field" value="" placeholder="Clave" id="login-pass" name ='clave' required>

	            </div>

	            <div class="form-group">
	              <input type="password" class="form-control login-field" value="" placeholder="Clave Otra Vez" id="login-match" required>
	            </div>

	            <input type="hidden" name="domicilio" value="">

	            <input type="hidden" name="foto" value="">


	            <button type="submit" class="btn btn-success btn-block" id='send'>

	            	Continuar

	            </button>
	         

			{!! Form::close() !!}


		</section>




@stop

@section('scripts')


	{!! HTML::script('/js/vendors/passValidator.js')!!}

	{!! HTML::script('/js/vendors/facebookRegister.js')!!}

@stop