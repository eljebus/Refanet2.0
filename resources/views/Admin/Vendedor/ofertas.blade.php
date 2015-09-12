@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/ofertas.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	

	<ul class="list-none" id='muro'>

		@if($datos['ofertas']->count() === 0)
			<center>
				
				<h4>
					Aún no has realizado ninguna oferta
				</h4>

			</center>
			
		@endif


		@foreach($datos['ofertas'] as $oferta)

			<?php $refaccion  = $oferta->publicacion()->first()->refaccion()->first();?>

				<?php
					$status = '';
					$estado = '';
					$accion = '';
					$url 	= '';
					switch ($oferta->publicacion()->first()->Status) {
					
						case '2':
							$status =	"acept";
							$estado =	'Oferta Aceptada';
							$accion = 	'Aceptar Compra';
							$url	= 	'/Vendedor/Aceptar/'.$oferta->idOferta;
							break;

						case '3':
							$status =	"sold";
							$estado =	'Oferta Pagada';
							$accion =	'Finalizar Oferta';
							break;

						default:
							$status = 	'neutral';
							$accion = 	'Ver';
							$url 	= 	'/Vendedor/Oferta/'.$oferta->idOferta;
							break;
					}

				?>

			<li class='{{$status}}'>

				
				<a href="/Vendedor/Oferta/{{$oferta->idOferta}}" title="">
				<div class="info">
					<p class='nombre orange  inline'>
						{{$refaccion->Nombre}}
					</p>

					<span class="date inline">
						{{$oferta->publicacion()->first()->Fecha}}
					</span>
					<span class="np">
						Referencia {{$oferta->publicacion()->first()->idPublicacion}}
					</span>
				</div>
				<div class="figura inline">
					<img src="{{$refaccion->galeria()->first()->Archivo}}" alt="">
				</div>

				<div class="description inline">

					<span class="mediumTitles">
						{{$estado}}
					</span>
					<p style='color: #727376;'>

						{{str_limit($refaccion->Descripcion,180,'...')}}
					</p>

					<div class="options">
					
						<aside class="edit verde alignCenter">
							
								<span class="glyphicon glyphicon-comment"></span>	
								{{$oferta->comentarios()->count()}} comentarios
						
							
							
						</aside>	
				</a>
						<aside class="verde floatRight offer">
							<a href='{{$url}}' class='btn btn-success btn-block'>
								
								{{$accion}}
							</a>
						</aside>


					</div>

				</div>

			</li>
		@endforeach


	
	</ul>


	<center>
		

		  {!! $datos['ofertas']->render() !!}

	</center>
	

	
	
@stop