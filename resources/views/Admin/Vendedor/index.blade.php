@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/index.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	

	<ul class="list-none" id='muro'>
		@if($datos['publicaciones']->count() === 0)
			<center>
				
				<h4>
					Aún no hay ninguna publicación disponible
				</h4>

			</center>
			
		@endif

		@foreach($datos['publicaciones'] as $publicacion)

		<li>
			<?php $refaccion  =  $publicacion->refaccion()->first(); ?>

			<div class="info">
				<p class='nombre orange  inline'>
					{{$refaccion->Nombre}}
				</p>

				<span class="date inline">
					{{$publicacion->Fecha}}
				</span>
				<span class="np">
					Referencia {{$publicacion->idPublicacion}}
				</span>
			</div>
			<div class="figura inline">
				<img src="{{$refaccion->galeria()
									  ->first()
									  ->Archivo}}" 

					 alt="{{$refaccion->galeria()
					 				  ->first()
					 				  ->Nombre}}">
			</div>

			<div class="description inline">
				<p>

					
					{{str_limit($refaccion->Descripcion,180,'...')}}

				</p>

				<div class="options">
				
					<aside class="edit verde alignCenter">
						
						<span class="icon-user"></span>	

						Comprador {{$publicacion->usuario()->first()->Nombre}}
					</aside>
					<aside class="verde floatRight offer">
						<a href='/Vendedor/Pieza/{{$publicacion->idPublicacion}}' class='btn btn-success btn-block'>
							
							Ofertar
						</a>
					</aside>


				</div>

			</div>

		</li>

		@endforeach
	

	
	</ul>


	<center>
		
		{!! $datos['publicaciones']->render() !!}

	</center>
	

	
	
@stop