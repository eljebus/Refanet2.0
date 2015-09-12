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

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">3</span>
					<p class='inline vmedio bottom-none'>Método de Pago</p>

				</li>

				<li class='itemActive'>

					<span class="itemCircle white inline vmedio ">4</span>
					<p class='inline vmedio bottom-none'>Todo Listo</p>

				</li>

			</ul>
			
		</div>

	

		<section id="registerForm" class='contentCenter'>

			<div class="floatLeft fontNormal">

				<?php  $user =  $datos['vendedor']->usuario()->first(); ?>

				<p class="mediumTitles orange">
					Mis Datos
				</p>

				<p>
					Nombre:
					<strong>
						
						{{$user->Nombre}}
					</strong>
				</p>

				<p>
					Mail:
					<strong>
						{{$user->Mail}}
					</strong>
				</p>
				<br>
				<p class="mediumTitles orange">Categorías</p>
				<ul class='fontNormal'>
					@foreach($datos['vendedor']->suscripciones()->get() as $suscripcion)
						<li>
							
							{{$suscripcion->categoria()->first()->Nombre}}
						</li>
					@endforeach
				</ul>

				<p class="mediumTitles orange">Marcas</p>
				<ul class='fontNormal'>
					@foreach($datos['vendedor']->suscripciones()->get() as $suscripcion)
						<li>
							
							{{$suscripcion->marca()->first()->Nombre}}
						</li>
					@endforeach
				</ul>

			</div>

			<div class="floatRight fontNormal">
				<p class="mediumTitles orange">
					Mi Cuenta
				</p>
				<p>
					Tipo de plan:
					<strong>{{$datos['contrato']->Tipo}}</strong>
				</p>

				<p>
					Fecha de Inicio: 
					<strong>{{$datos['contrato']->Inicio}}</strong>
				</p>

				<p>
					Próximo Pago: 
					<strong>{{$datos['contrato']->Fin}}</strong>
				</p>

				
		         <br>
		         <br>
		         <a href='/Vendedor' class='btn btn-success btn-block' name="">Finalizar</A>

			</div>

			
			

		</section>




@stop

@section('scripts')






@stop