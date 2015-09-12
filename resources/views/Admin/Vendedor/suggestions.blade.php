@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/index.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')
	

	<ul class="list-none" id='muro'>
		

		


		@if(!is_null($datos['refacciones']))
		
			<p>
				Publicaciones sugeridas por <strong>REFANET</strong>
			</p>	

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
		

				
				

		@else
			

			<p>
				No hay ninguna publicacion sugeriada para tí
			</p>
		@endif





		
	</ul>

	@if(!is_null($datos['refacciones']))
		<center>
			

			  {!! $datos['refacciones']->render() !!}

		</center>
	@endif
	

	
	
@stop