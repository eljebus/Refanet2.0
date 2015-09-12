@extends('Admin/Comprador/origin')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/buy.css') !!}
		<style>
			iframe{
				display: none;
			}
		</style>

@stop


@section('pre-content')
	
@stop


@section('content')
		<div class='bg-gray'>

			<ul class='list-none contentCenter' id='etapas'>

				<li class='itemActive begin'>

					<span class="itemCircle  white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Seleccionar Método</p>

				</li>

				<li class='itemInactive finish'>

					<span class="itemCircle white inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Realizar Compra</p>

				</li>

			</ul>
			
		</div>
		<section id="registerForm" class='contentCenter'>

	

				<h3 class="bigTitles inline vmedio fontNormal top-none">
					Oferta {{$datos['oferta']->idOferta}} 
				</h3>

				<h4 class='inline vmedio fontNormal top-none mediumTitles'>
					Monto: 
					<span class="orange"> 
						$ {{number_format( $datos['oferta']->Precio, 2, '.', ', ' )}}
					</span>
				</h4>

				<br><br>
				<br><br>
				<div id="methods">

					@if($datos['oferta']->vendedor()->first()->Publica != "")
						<aside class="metodo fontNormal inline thumbnail">
							<div class="tile tile-hot">

					            <img src="/images/icons/png/card.png" alt="Chat" class="tile-image">

					            <h3 class="tile-title">
					            	Pago REFANET
					            </h3>
					            <p>
					            	Paga directamente en la plataforma, con tu tarjeta de crédito fácil y rápido
					            </p>

					            <a 	class 		=	"btn btn-primary btn-large btn-block methodName" 
					            	href 		=	"#" 
					            	data-method	=	'card'>

					            	Comprar la pieza

					            </a>

					        </div>

						</aside>
					@endif


					<aside class="metodo fontNormal inline ultimo thumbnail">
						<div class="tile">

				            <img 	src 	=	"/images/icons/svg/Pencils.svg" 
				            		alt 	=	"Chat" 
				            		class 	=	"tile-image">

				            <h3 class="tile-title">
				            	Contacto Directo
				            </h3>

				            <p>
				            	Contacta Directamente con el Vendedor de la pieza 
				            	<br>(El proceso implica pasos adicionales)
				            </p>

				            <a 	class 		=	"btn btn-primary btn-large btn-block methodName" 
				            	href 		=	"#"  
				            	data-method =	'contact'>

				            	Contactar al anunciante

				            </a>

				        </div>

					</aside>
				</div>


				<div id="card">


					{!! Form::open(array('id'=>'cardForm')) !!}


						<div class="floatLeft fontNormal">

							<textarea 	class		=	"form-control" 
										placeholder	=	'Comentarios adicionales'
										name 		=  	'Comentarios' 
										required></textarea>

						</div>

						<div class="floatRight">
							<span class="errorMassage" id='cardError'></span>

							<div class="form-group">

				              <input 	type		=	"text" 
				              			class		=	"form-control login-field" 
				              			value 		=	"" 
				              			placeholder	=	"Numero de Tarjeta" 
				              			id			=	"login-name" 
				              			name		= 	'Numero'
				              			required
				              >

				            </div>

				            <input 	type	=	"hidden"
				            		name	=	'Name'
				            		value	=	"{{$dataUser['userName']}}"
				            >

				            <input 	type = "hidden"
				            		name = 'oferta'
				            		value= "{{$datos['oferta']->idOferta}}" >

				            <div class="form-group doble inline">

								<input 	type 		=	"text" 
										class 		=	"form-control login-field" 
										value 		=	"" 
										placeholder =	"Mes" 
										id 			=	"login-name" 
										name 		=   'Month'
										required
								>

					        </div>

				            <div class="form-group doble ultimo inline">

								<input 	type 		=	"text" 
										class 		=	"form-control login-field" 
										value 		=	"" 
										placeholder =	"Año" 
										name		= 	'Year'
										required
								>

				            </div>

				            <div class="form-group doble inline vmedio">

								<input 	type 		=	"text" 
										class 		=	"form-control login-field" 
										value 		=	"" 
										name		= 	'Cvc'
										placeholder =	"Ultimos tres digitos" 
										required
								>

				            </div>

				            <div class="doble inline fontNormal ultimo vmedio">

				              <span class="glyphicon glyphicon-credit-card inline vmedio"></span>
				              <span class="inline vmedio"> Ultimos tres digitos</span>
				              
				            </div>

				             <button 	type="submit" 
				             			class="btn btn-primary btn-large btn-block" 
				             			id='send'>

					            Realizar el pago 
					         </button>
						</div>



					{!! Form::close() !!}

				</div>

				<div id="contact">


					<div class="alert alert-success fontNormal" role="alert">
				      <strong>Listo!</strong> 
				      Se ha notificado al vendedor para que se ponga en contacto contigo, te proporcionamos a continuación los datos del mismo
				    </div>


					<div class="dataProfile fontNormal">

				
						<p class="bigTitles orange"> 
							Acabas de comprar refacción para {{$datos['oferta']->publicacion()
																->first()
																->refaccion()
																->first()
																->Nombre}}
						</p>

						<span class="avatar inline vmedio">
				  			<img src="" id='Avatar'>
				  		</span>
				  		
				  		<span 	class			=	"inline name vmedio profile" 
				  				data-idprofile	=	'1'>

				  			 &nbsp;<span id='userName'></span>

				  		</span>

				  		<div id="note">
				  			
				  		</div>

				  		<span class="mail">

				  			<span class="glyphicon glyphicon-envelope"> </span>
				  			<span id='Mail'></span>

				  		</span>

						<br>
				  		<span class='mail'>
				  			
				  			<span class='glyphicon glyphicon-earphone'></span>
				  			<span id='tel'></span>
				  		</span>
				  		
				  		<br>
				  		<span>

				  			<span class="glyphicon glyphicon-send"></span>
				  			
				  			<span id='Address'></span>	

				  		</span>

				  		<div 	class	=	"alert alert-info minAlert" 
				  				role	=	"alert">

					      		<strong>Recuerda</strong> 
					      		Cuando recibas tu pieza finaliza la compra y califica al vendedor

					    </div>

						<a 	href	=	"/Comprador/Compras" 
							class	=	"btn btn-primary btn-large btn-block">
							Listo
						</a>


					</div>



				</div>


		</section>
				

	



	
	
@stop

@section('scripts')
	
	<script>

		//obtenemos la llave publica del vendedor para tokenizar tarjetas

		var key = "{{$datos['oferta']->vendedor()->first()->Publica}}";

	</script>

	{!! HTML::script('https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js')!!}
	{!! HTML::script('/js/vendors/conekta.js')!!}
	{!! HTML::script('/js/Comprador/method.js')!!}


@stop