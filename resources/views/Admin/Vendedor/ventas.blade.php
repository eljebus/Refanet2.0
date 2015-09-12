@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/compras.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')


	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='np'>
	  			Referencia
	  		</li>

	  		<li class="name">
	  			Nombre de la Pieza
	  		</li>

	  		<li class='car'> Vehículo</li>

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
	@if($datos['ofertas']->count() === 0)
			<center>
				
				<h4>
					Aún no has realizado ninguna venta
				</h4>

			</center>
			
		@endif

	  <table class="table">
	  	@foreach($datos['ofertas'] as $oferta)

			<?php $compra =  $oferta->compra()->first(); ?>
		  	<tr>
		  		<td class='np' valign='middle'>	
					<center>
						{{$compra->idCompra}}
					</center>
		  			
		  		</td>

		  		<td class='name' valign='middle'>
		  			<a href="/Vendedor/Oferta/{{$oferta->idOferta}}">
			  			{{$oferta->publicacion()->first()->refaccion()->first()->Nombre}}
			  		</a>
		  		</td>

		  		<td class='car' valign='middle'>
		  			{{$oferta->publicacion()->first()->refaccion()->first()->Tipo}}
		  			/
		  			{{$oferta->publicacion()->first()->refaccion()->first()->Modelo}}

		  		</td>

		  		<td class='date' valign='middle'>
		  			{{$compra->Fecha}}
		  		</td>

		  		<td class='type' valign='middle'>
		  			{{$compra->Forma}}
		  		</td>

		  		<td class='status' valign='middle'>
		  			
		  			@if($compra->Status === 'F' or $compra->Status === 'C' )
						
						Finalizada
					@else

						<a 	href	=	"/Vendedor/Finalizar/{{$compra->idCompra}}" 
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
		
		{!! $datos['ofertas']->render() !!}

	</center>
	

	
	
@stop