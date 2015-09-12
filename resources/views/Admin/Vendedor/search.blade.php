@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/index.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')
	

	<ul class="list-none" id='muro'>
		

		


		@if( $datos['refacciones']->count() === 0  && is_null($datos['publicacionesId']))
		
			<p>
				El término 
				<strong>
					<i>
						"{{$datos['busqueda']}}"
					</i>
				</strong> 
				no produjo resultados
			</p>
				
				

		@else
			<p>
				Resultados de
				<strong>
					<i>
						"{{$datos['busqueda']}}"
					</i>
				</strong> 
			</p>	
		@endif


@foreach ($datos['refacciones'] as $refaccion)

		<?php $publicacion =  $refaccion->publicacion()->first(); ?>

			<li class='thumbnail'>

				<div class="info">
					<p class='nombre orange  inline'>
						{{$publicacion->refaccion()->first()->Nombre}}
					</p>

					<span class="date inline">
						{{$publicacion->Fecha}}
					</span>
					<span class="np">
						Referencia {{$publicacion->idPublicacion}}
					</span>
				</div>
				<div class="figura inline">
					<img src="{{$publicacion->refaccion()
											->first()
											->galeria()
											->where('Status','=',1)
											->first()
											->Archivo}}" alt="">
				</div>

				<div class="description inline ">
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
	



		<?php $publicacion = $datos['publicacionesId'];  ?>

		@if(!is_null($publicacion))

			<li class='thumbnail'>

				<div class="info">
					<p class='nombre orange  inline'>
						{{$publicacion->refaccion()->first()->Nombre}}
					</p>

					<span class="date inline">
						{{$publicacion->Fecha}}
					</span>
					<span class="np">
						Referencia {{$publicacion->idPublicacion}}
					</span>
				</div>
				<div class="figura inline">
					<img src="{{$publicacion->refaccion()
											->first()
											->galeria()
											->where('Status','=',1)
											->first()
											->Archivo}}" alt="">
				</div>

				<div class="description inline ">
					<p>

						{{str_limit($publicacion->refaccion()->first()->Descripcion,180,'...')}}
					</p>

					<div class="options">
						<aside class="offer orange alignLeft">
							<a href="/Comprador/Publicacion/{{$publicacion->idPublicacion}}" title="">
								<span class='glyphicon glyphicon-tags'></span>
								{{$publicacion->ofertas()->count()}} Ofertas
							</a>
						</aside>
						
						@if($publicacion->Status === 2)
							<aside class="edit verde alignRight">
								<span class='glyphicon glyphicon-thumbs-up'></span>
								
								Finalizada

							</aside>

						@else
							<aside class="edit rojo alignRight">
								<a 	href	="/Comprador/Editar/{{$publicacion->idPublicacion}}" 
									class	='rojo' 
									title 	="">
									<span class='glyphicon glyphicon-pencil'></span>

									Editar Publicación
								</a>
							</aside>
						@endif



					</div>

				</div>

			</li>
		@endif

	</ul>


	<center>
		

		  {!! $datos['refacciones']->render() !!}

	</center>
	

	
	
@stop