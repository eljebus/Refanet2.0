@extends('layout')


@section('styles')

		{!! HTML::style('/css/finalizarRegistro.css') !!}

@stop


@section('pre-content')



	
@stop


@section('content')
	
		<div class='bg-gray'>
			<ul class='list-none contentCenter' id='etapas'>
				<li class='itemInactive'>
					<a href="/Registro/Comprador/inicio" title="Registrarme">
						<span class="itemCircle white inline vmedio ">1</span>
						<p class='inline vmedio bottom-none'>Registrarme</p>
					</a>
				</li>

				<li class='itemInactive'>
					<a href="/Registro/Comprador/detalles" title="Detalles de la Pieza">
						<span class="itemCircle white inline vmedio ">2</span>
						<p class='inline vmedio bottom-none'>Detalles de la Pieza</p>
					</a>
				</li>

				<li class='itemActive'>
					<a href="/Registro/Comprador/finalizar" title="Recibir Ofertas">
						<span class="itemCircle white inline vmedio ">3</span>
						<p class='inline vmedio bottom-none'>Publicar Refacción</p>
					</a>

				</li>


			</ul>
			
		</div>

		<section id="registerForm" class='contentCenter'>

			<div id='izquierda' class='fontNormal'>

				<p class='smallTitles'>
					<span class="icon-user orange"></span> 


					<strong>{{ $datos['user']->Nombre}}</strong>
				</p>

				<p class='smallTitles'>
					<span class="icon-mail2 orange"></span> 
					<strong>{{ $datos['user']->Mail}}</strong>
				</p>

				<p>
					Categoría: <strong>{{$datos['categoria']}}</strong>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					Marca del Vehículo: <strong>{{$datos['marca']}}</strong>
				</p>

				<p>
					Tipo de Vehículo: <strong>{{$datos['pieza']->Tipo}}</strong> 
					&nbsp;&nbsp;&nbsp;&nbsp; Modelo: <strong>{{$datos['pieza']->Modelo}}</strong>
				</p>

				<p>
					<strong>{{$datos['pieza']['Nombre']}}</strong> 
				</p>

				<p>Descripcion Detallada:<br>

					{{$datos['pieza']->Descripcion}}
				</p>

				
				
			</div>
			<div id="derecha">


				<div class="imageContainer">

					<img src="{{$datos['pieza']->galeria()->first()->Archivo}}" alt="" width = '100%'>

				</div>
				<br>
				<a href='/Registro/Comprador/Publicar' class="btn btn-success btn-block fontNormal">

	            	Publicar Refacción 
	            </a>


			</div>
		




		</section>




@stop

