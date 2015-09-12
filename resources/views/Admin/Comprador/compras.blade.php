@extends('Admin/Comprador/layout')


@section('styles')

	{!! HTML::style('/css/Admin/Comprador/compras.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')


	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='np'>
	  			Ref
	  		</li>

	  		<li class="name">
	  			Nombre de la Pieza
	  		</li>

	  		<li class='car'>

	  			Vehículo

	  		</li>

	  		<li class="date">
	  			Fecha
	  		</li>

	  		<li class="type">
	  			Tipo
	  		</li>

	  		<li class="status">
	  			Estado
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">

		
		@if( $datos['compras']->count() === 0 )
			
			<tr>
				
				<td>
					
					No haz realizado ninguna compra
				</td>
			</tr>

			
		@endif


	  	@foreach($datos['compras'] as $compra)

	  		<?php $refaccion =$compra->publicacion()
		  					->first()
		  					->refaccion()
		  					->first() ?>
		  	<tr>
		  		<td class='np'>	
		  			{{$compra->idCompra}}
		  		</td>

		  		<td class='name'>
		  			<a href="/Comprador/Publicacion/{{$compra->publicacion()
		  													->first()
		  													->idPublicacion}}">
			  			{{$refaccion->Nombre}}
			  		</a>
		  		</td>

		  		<td class="car">
		  			{{$refaccion->Tipo}}  

		  			{{$refaccion->Modelo}}
		  		</td>

		  		<td class='date'>
		  			{{$compra->Fecha}}
		  		</td>

		  		<td class='type'>
		  			{{$compra->Forma}}
		  		</td>

		  		<td class='status'>


					@if($compra->Status === 'P')
						Pendiente
		  			
		 			

			        @elseif($compra->Status === 'F' or $compra->Status === 'T')

		  				
			            	Finalizado

			        @else

		  				<a 	href	=	"/Comprador/Finalizar/{{$compra->idCompra}}" 
							class	=	"btn btn-success inline buy">

			            	Finalizar
			            </a>

			
		  			@endif
		  		
		  		</td>
		  	</tr>

	  	@endforeach

	 
	  </table>
	</div>

	<center>
		

		  {!! $datos['compras']->render() !!}

	</center>
	
	
	
@stop