@extends('layout')


@section('styles')

		{!! HTML::style('/css/registroSeller.css') !!}

@stop


@section('pre-content')



	
@stop


@section('content')

		<div class='bg-gray'>
			<ul class='list-none contentCenter' id='etapas'>
			<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Registrarme</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Suscripciones</p>

				</li>

				<li class='itemActive'>

					<span class="itemCircle white inline vmedio ">3</span>
					<p class='inline vmedio bottom-none'>Método de Pago</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">4</span>
					<p class='inline vmedio bottom-none'>Todo Listo</p>

				</li>

			</ul>
			
		</div>

	

		<section id="registerForm" class='contentCenter'>

			<div class="floatLeft">


				<div class="pallete-item fontNormal" data-plan='Mes'>

			      	<div class="palette superior">
			      		<span class="icon-checkmark"></span>
			      		<p class="mediumTitles">
			      			Mensual
			      		</p>
			      		<p>
			      			Mensualidad con acceso a todos los servicios,
			      			cancela en el momento que tu decidas, sin planes forzosos

			      		</p>
		              
		            </div>
		            <ul>
		      			<li>30 días</li>
		      			<li>Ventas Ilimitadas</li>
		      			<li>Nofiticaciones en mail</li>
		      			<li>Pagos ONLINE</li>

		      		</ul>
		            <div class="palette inferior">
		              <p class="bigTitles bottom-none center">
		              	$ 400.00
		              </p>
		            </div>
		      </div>

		       <div class="pallete-item fontNormal"  data-plan='Semestral'>

			      	<div class="palette superior" style='background:#ffb432'>
			      		<span class="icon-checkmark"></span>
			      		<p class="mediumTitles">
			      			Semestral
			      		</p>
			      		<p>
			      			Ahorra contratando el plan semestral y disfruta del mejor servicio para encontrar a tus clientes

			      		</p>

			      		
		              
		            </div>
		            <ul style='background:#ffe1ac'>
		      			<li>6 Meses </li>
		      			<li>Ventas Ilimitadas</li>
		      			<li>Nofiticaciones en mail</li>
		      			<li>Pagsos ONLINE</li>
		      		</ul>
		            <div class="palette inferior">
		              <p class="bigTitles bottom-none center" style='background:#ffb432'>
		              	$ 2, 000.00
		              </p>
		            </div>
		      </div>

		      <div class="pallete-item fontNormal" id='ultimo' data-plan='Anual'>

			      	<div class="palette superior" style='background:#a0d468'>
			      		<span class="icon-checkmark"></span>
			      		<p class="mediumTitles">
			      			Anual
			      		</p>
			      		<p>
			      			Ahorra aún más contratando nuestro plan anual con todos los beneficios y funciones

			      		</p>

			      		
		              
		            </div>
		            <ul style='background:#ebf6df'>
		      			<li>12 Meses </li>
		      			<li>Ventas Ilimitadas</li>
		      			<li>Nofiticaciones en mail</li>
		      			<li>Pagsos ONLINE</li>
		      		</ul>
		            <div class="palette inferior">
		              <p class="bigTitles bottom-none center" style='background:#a0d468'>
		              	$ 3, 900.00
		              </p>
		            </div>
		      </div>

			</div>

			<div class="floatRight">


				<div class="btn-group" data-toggle="buttons">

				  <label class="btn btn-primary active ">

				    <input 	type		="radio" 
				    		name		="metodo" 
				    		value		="card" 
				    		autocomplete="off" 
				    		checked> Tarjeta de crédito
				  </label>

				   <label class="btn btn-primary">

				    <input 	type		="radio" 
				    		name		="metodo" 
				    		value		="oxxo" 
				    		autocomplete="off" 
				    		checked> Pago en OXXO
				  </label>
				 

				 

				</div>

				<br>
				<br>

				{!! Form::open(array(	'url' 	=> '/Vendedor/savePay',
										'id'	=>	'payFormOxxo',
										'method'=>	'POST')) !!}

						<br>
						<span class="errorMassage cardError"></span>

						<input type="hidden" name='Plan'>
						<input type="hidden" name='Type' value= 'Oxxo'>

						<div class="checkboxField">


							<input 	type="checkbox" 
									name="auto" 
									id='terminos' 
									value=""
									required>
							<label for='terminos'> 
								<small>

									<a href="/terminos">
										
										Acepto los terminos y condiciones
									</a>
									
									
								</small>
							</label>

			            </div>
			            <br>

						 <button 	id		='oxxoForm' 
			             			class	="btn btn-success btn-block send"
			             			>

				            Descargar orden de pago
				         </button>


				{!! Form::close() !!}


				{!! Form::open(array(	'url' 	=> 'Registro/Vendedor/finalizar',
										'id'	=>	'payForm')) !!}

						<span class="errorMassage cardError"></span>
						<div class="form-group">
			              <input 	type="text" 
			              			class="form-control login-field" 
			              			value="" 
			              			name ='Numero'
			              			placeholder="Numero de Tarjeta" 
			              			id="login-name" 
			              			required>
			            </div>

			            <input type="hidden" name='Name' value = 'Unknown'>
			            <input type="hidden" name='Plan' required>
			            <input type="hidden" name='Type' value= 'Card'>

			            <div class="form-group doble inline">
				              <input 	type	=	"text" 
				              			class	=	"form-control login-field" 
				              			value=""
				              			name = 'Month' 
				              			placeholder="Mes" 
				              			id="login-name" 
				              			required>
				         </div>
			            <div class="form-group doble ultimo inline">
			              <input 	type="text" 
			              			class="form-control login-field" 
			              			value=""
			              			name = 'Year' 
			              			placeholder="Año" 
			              			id="login-name" 
			              			required>
			            </div>

			            <div class="form-group doble inline vmedio bottom-none">
			              <input 	type="password" 
			              			class="form-control login-field bottom-none" 
			              			value=""
			              			name = 'Cvc' 
			              			id="login-name" 
			              			required>
			            </div>

			            <div class="doble inline fontNormal ultimo vmedio">
			              <span class="glyphicon glyphicon-credit-card inline vmedio"></span>
			              <span class="inline vmedio"> CVC</span>
			              
			            </div>
			            <br>
			            <br>


			      
						<div class="checkboxField">


							<input 	type="checkbox" 
									name="auto" 
									id='terminos' 
									value=""
									required>
							<label for='terminos'> 
								<small>
									
									<a href="/terminos">
										
										Acepto los terminos y condiciones
									</a>

								</small>
								
							</label>

			            </div>
			            <br>

			             <button 	type	="submit" 
			             			class	="btn btn-success btn-block send"
			             			>

				            Realizar el pago 
				         </button>

				{!! Form::close() !!}


			</div>
			

		</section>




@stop

@section('scripts')

	
	{!! HTML::script('https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js')!!}

	{!! HTML::script('/js/vendors/conekta.js')!!}

	{!! HTML::script('/js/Vendedor/metodo.js')!!}

	{!! HTML::script('/js/Vendedor/pay.js')!!}




@stop