@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/index.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')
	

	<p>Resultados para "<strong><i>{{$datos['query']}}</i></strong>"</p>


	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='ref'>
	  			Referencia
	  		</li>

	  		<li class="name">
	  			Nombre
	  		</li>

	  		<li class="mail">
	  			Mail
	  		</li>

	  		<li class="date">
	  			Desde
	  		</li>

	  		<li class="status">
	  			Reputación
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">

	  	@foreach( $datos ['usuarios'] as $usuario)

		  	<tr>
		  		<td class='ref'>
		  			
		  			{{$usuario->id}}

		  		</td>

		  		<td class='name'>
		  			<a href="/Administrador/Perfil/{{$usuario->id}}">
		  				{{$usuario->Nombre}}
		  			</a>
		  		</td>

		  		<td class='mail'>
		  			{{$usuario->Mail}}
		  		</td>

		  		<td class='date'>
		  			{{$usuario->updated_at}}
		  		</td>

		  		<td class='status'>
		  			
		  			@if(!is_null($usuario->reputacion()->first()['Calificacion']))

		  				{{$usuario->reputacion()->first()['Calificacion']}}
						Estrellas
					@else
						Sin calificar
		  			@endif

					
		  			
		  		</td>
		  	</tr>
	  	@endforeach
			

	  	@if(array_key_exists('idClient',$datos))
			
		<?php $usuario =  $datos['idClient'	]; ?>


			<tr>
		  		<td class='ref'>
		  			
		  				{{$usuario->id}}

		  		</td>

		  		<td class='name'>
		  			<a href="/Administrador/Perfil/{{$usuario->id}}">
		  				{{$usuario->Nombre}}
		  			</a>
		  		</td>

		  		<td class='mail'>
		  			{{$usuario->Mail}}
		  		</td>

		  		<td class='date'>
		  			{{$usuario->update_at}}
		  		</td>

		  		<td class='status'>
		  			
		  			@if(!is_null($usuario->reputacion()->first()['Calificacion']))

		  				{{$usuario->reputacion()->first()['Calificacion']}}
						Estrellas
					@else
						Sin calificar
		  			@endif

					
		  			
		  		</td>
		  	</tr>

	  	@endif


	  </table>
	</div>

	<center>
		{{$datos['usuarios']->render()}}	

	</center>
	

	
	

	
	
@stop