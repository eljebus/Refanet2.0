@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/index.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')
	

	<ul class="list-none" id='muro'>
		<li id='nueva' class='thumbnail'>

			<a href='/Comprador/Nueva' >
				<span class='glyphicon glyphicon-plus-sign'></span>
				Nueva Publicación
			</a>
		</li>


		@if( $datos['publicaciones']->count() === 0 )
		
			
				
				No hay ninguna publicación

			
		@endif


		@foreach ($datos['publicaciones'] as $publicacion)
			
			<li class='thumbnail'>
					<a href="/Comprador/Publicacion/{{$publicacion->idPublicacion}}" style='color:#428bca'>
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
							<img src="@if(!is_null($publicacion->refaccion()
													->first()
													->galeria()
													->where('Status','=',1)
													->first()))

														{{$publicacion->refaccion()
																		->first()
																		->galeria()
																		->where('Status','=',1)
																		->first()
																		->Archivo}}
									@else
										/images/noimage.jpg
									@endif">
						</div>

						<div class="description inline ">
							<p style='color:#727376'>

								{{str_limit($publicacion->refaccion()->first()->Descripcion,180,'...')}}
							</p>

							<div class="options">
								<aside class="offer alignLeft">
									
										<span class='glyphicon glyphicon-tags'></span>  
										{{$publicacion->ofertas()->count()}} Ofertas
								
								</aside>	
					</a>
						<aside class="edit rojo alignCenter">
							<a 	href	="/Comprador/Editar/{{$publicacion->idPublicacion}}" 
								class	='rojo' 
								title 	="">
								<span class='glyphicon glyphicon-pencil'></span>

								Editar Publicación
							</a>
						</aside>
						<!--<aside class="edit verde alignRight">
							<span class='glyphicon glyphicon-hand-right'></span>
							Ofrecer a Proveedor
						</aside>-->


					</div>

				</div>

			</li>

		@endforeach
	

	
	</ul>


	<center>
		

		  {!! $datos['publicaciones']->render() !!}

	</center>
	

	
	
@stop