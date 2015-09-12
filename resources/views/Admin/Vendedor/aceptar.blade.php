@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/finalizar.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')


	<?php  $refaccion = $datos['oferta']->publicacion()->first()->refaccion()->first(); ?>
	
	
	<h2 class="mediumTitles orange  fontNormal inline top-none">{{$refaccion->Nombre}}</h2>
	
	<span class="floatRight">Referencia {{$datos['oferta']->idOferta}}</span>
	<div id="container">
		<div class="floatLeft">
			<img src="{{$datos['oferta']->refaccion()->first()->galeria()->where('Status','=',1)->first()->Archivo}}">
		</div>
		<div class="floatRight fontNormal">
			<span class="monto">
				<span class="glyphicon glyphicon-certificate inline vmedio"></span>
				<span class='inline vmedio'> 
					Monto: $ {{number_format( $datos['oferta']->Precio, 2, '.', ', ' )}}
				</span>
			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-user inline vmedio"></span>
				<span class='inline vmedio'> 

					<?php $publicacion = $datos['oferta']->publicacion()->first(); ?>

					Comprador: {{$publicacion->usuario()->first()->Nombre}} 
					&nbsp;&nbsp;&nbsp;&nbsp;
					Mail: {{$publicacion->usuario()->first()->Mail}} 
				</span>

			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-credit-card inline vmedio"></span>
				<span class='inline vmedio'> 
					Pago: {{$datos['oferta']->compra()->first()->Forma}}
				</span>
			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-map-marker inline vmedio"></span>
				<span class='inline vmedio'> 
					Dirección de Comprador: {{$publicacion->usuario()->first()->Domicilio}} 
				</span>
			</span>

			<a href="/Vendedor/Oferta/{{$datos['oferta']->idOferta}}" title="Comentar"> 
				Realizar comentario
			</a>
			<br>
			<br>
			<a 	href	=	"/Vendedor/Complete/{{$datos['oferta']->idOferta}}" 
				class	=	"btn btn-success inline buy">

            	Aceptar Compra
            </a>



		</div>
	</div>
	
	
	
@stop
@section('scripts')
	
	{!! HTML::script('/js/Comprador/finalizar.js')!!}


@stop