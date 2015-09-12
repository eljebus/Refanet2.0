@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/post.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	
	<?php $bandera = false; ?>

	<?php $flag = false; ?>


	@if($datos['post']->Status > 1 )

		<?php $bandera = true; ?>
		
		@if($datos['post']->compra()->first()->Status === 'F' or  $datos['post']->compra()->first()->Status === 'C')

			


			<?php $flag = true; ?>


		@endif


	@endif


	



	<section id="imagenes">

	
		<aside class="izquierda inline">

			<ul class="list-none">

				@if($datos['galeria']->count() === 0)

					<img src="/images/noimage.jpg" alt="">
					
				@endif
				
				@foreach($datos['galeria']->get() as $photo)

					<li>
						<img src="{{$photo->Archivo}}" alt="{{$photo->Nombre}}">

						<span 	class		=	"	glyphicon 
													glyphicon-resize-full 
													fullSize 
													bg-blue 
													white
												" 
								data-toggle	=	"modal" 
								data-target	=	"#fullSize" 
								data-title 	= 	'Marcha Mecanica'></span>
					</li>

				@endforeach


				
			</ul>

		</aside>

		<aside class="derecha inline">

			<h2 class="bigTitles textNormal fontNormal top-none">

				{{$datos['post']->refaccion()
								->first()
								->Nombre}}  
				@if($bandera)

					@if($flag)
						&nbsp;&nbsp;&nbsp;&nbsp;
						<small>
							
							<i>
								Transacción finalizada
							</i>

						</small>
					
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;
						<small>
							
							<i>
								Transacción en proceso
							</i>

						</small>
						&nbsp;&nbsp;
						<button type="button" 
								class="btn btn-danger btn-xs" 
								data-toggle="modal" 
								data-target="#danger">

								Cancelar proceso
						</button>

					@endif
					
					
				@endif
			</h2>




			<span class='categoria fontNormal textBold inline'>

				{{$datos['post']->categoria()
								->first()
								->Nombre}}
			</span>
			<br>
			<span class='tipo fontNormal textBold inline'>

				Tipo {{$datos['post']->refaccion()
									->first()
									->Tipo}}
			</span>

			<span class='modelo fontNormal textBold inline'>

				Modelo {{$datos['post']->refaccion()
										->first()
										->Modelo}}
			</span>
			

			
			<article class='fontNormal'>
				<span class='verde'> Descripción</span>
				<br>
				{{$datos['post']->refaccion()->first()->Descripcion}}
				
			</article>

		</aside>



	</section>

	<ul class="list-group fontNormal offers ">

		@if($datos['post']->ofertas()
								->orderBy('idOferta','DESC')
								->count() == 0)


			<li>
				
				Aún no se ha hecho ninguna oferta a esta publicación

			</li>

		@endif

		@foreach($datos['post']->ofertas()
								->orderBy('idOferta','DESC')
								->get() as $oferta)


		


			<li class="list-group-item">
				
				<div class="info">
					<span class="avatar inline vmedio">
						<img src="{{$oferta->vendedor()
										   ->first()
										   ->usuario()
										   ->first()
										   ->Avatar}}" >
					</span>
					<span 	class 			=	"inline name vmedio profile" 
							data-idprofile 	=	'1'>

						 &nbsp;{{$oferta->vendedor()
						 				->first()
						 				->usuario()
						 				->first()
						 				->Nombre}}

					</span>

					<span class="price orange textBold">

						$ {{number_format( $oferta->Precio, 2, '.', ', ' )}}

					</span>
						
					&nbsp;&nbsp;&nbsp;&nbsp;

					<span class='inline vmedio'>
							<?php

		
								switch ($oferta->Estado) {
								
									case 'A':
										print('Nueva');
										break;

									case 'B':
										print('Genérica');
										break;

									default:
										print('Usada');
										break;
								}


							?>
					</span>
					<span class="floatRight">
						Referencia {{$oferta->idOferta}}
					</span>

				</div>	

				<article class='description'>
					
					{{$oferta->refaccion()->first()->Descripcion}}
						/
					<i>
						<strong>
							<small>
								Se entrega en {{$oferta->TiempoE}}
							</small>
						</strong>
					</i>

				</article>

				<div class="icons">

					<span 	class 		=	"coment verde inline" 
							data-status =	'hide' 
							id 			=	'offerComent-{{$oferta->idOferta}}'>

						<span class="glyphicon glyphicon-comment"></span>
						&nbsp;


						Comentarios (<span class='comentNum'>
										{{$oferta->comentarios()->count()}}
									</span>)
						
					</span>
					<span 	class 		=	"inline photos verde" 
							data-photos = 	'@foreach($oferta->refaccion()
															->first()
															->galeria()
															->where("Status","=",1)
															->get() as $photo)
															{{$photo->Archivo}}[photo]@endforeach'>

						<span class="glyphicon glyphicon-picture"></span>
						&nbsp;
						Fotos ({{$oferta->refaccion()->first()
													 ->galeria()
													 ->where("Status","=",1)
													 ->count()}})
					</span>
					
					@if($bandera === false)
						<a 	href 	=	"/Comprador/Compra/{{$oferta->idOferta}}"
							class	=	"btn btn-success inline buy">
					
							Comprar

						</a>
					@else
								&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
							@if($flag)
								<small>Transacción finalizada</small>
							@else
								<small>Cancela para poder comprar</small>
							@endif
							
						
					@endif


				</div>

				<div class 	=	'newComent extra'>

					<span class = "avatar inline">
						<img src = "{{$dataUser['user']->Avatar}}" class='photoAvatar'>
					</span>

					<textarea 	class 		=	"form-control inline commentContent"  
								placeholder =	'Escribe aquí tu comentario' 
								required  
								id 			=	'area{{$oferta->idOferta}}'
								data-id		=	'{{$oferta->idOferta}}'
								data-user	= 	"{{$dataUser['userName']}}"></textarea>

				</div>

			</li>

			<div  class="groupComments" id='groupComments-{{$oferta->idOferta}}'>


				@foreach($oferta->comentarios()
								->orderBy('idComentarios','DESC')
								->get() as $comentario)

				  	<li class="list-group-item comments">

					  		<span class="avatar inline">

					  			<img 	src 	=	"{{$comentario->usuario()->first()->Avatar}}" 
					  			 		class	=	"inline vmedio">

					  		</span>

					  		<p class = "inline textComment">

					  			<span class = "verde">
					  				{{$comentario->usuario()->first()->Nombre}}:
					  			</span>

					  			{{$comentario->Comentario}}

					  		</p>
					</li>

				@endforeach
				
			</div>


		  @endforeach
	  

	 
	 
	</ul>



	<!-- modal de imagen tamaño reputacion -->
	<div 	class 			=	"modal fade" 
			tabindex 		=	"-1" 
			role			=	"dialog" 
			aria-labelledby	=	"LargeModalLabel" 
			aria-hidden		=	"true" 
			id				=	"perfil">

	  <div class="modal-dialog modal-sm">

	    <div class="modal-content">

	      <div class="modal-header">
	        <button type		=	"button" 
	        		class		=	"close" 
	        		data-dismiss=	"modal">

        		<span aria-hidden="true">&times;</span>
        		<span class="sr-only">Close</span>

	        </button>


	        <h5 class	=	"modal-title fontNormal middle smallTitles" 
	        	id 		=	"imageLabel">
	        	Información del vendedor
	        </h5>

	      </div>

	      <div class="modal-body">

	      		<span class="avatar  vmedio" >
		  			<img src="" id='vAvatar' width='50'>
		  		</span>
		  		<br>
		  		<h7 class='orange'>
		  			
		  		</h7>
		  		<div id="note">
		  			
		  		</div>
		  		
		  		<div id='comments'>
		  			
				<p>Últimos comentarios</p>

	  				<ul class="list-group">



		  			

					</ul>

		  		</div>

	      </div>

	    </div>

	  </div>

	</div>
	
	<!-- modal de imagen tamaño completo -->
	<div 	class	 		=	"modal fade" 
			tabindex 		=	"-1" 
			role	 		=	"dialog" 
			aria-labelledby =	"LargeModalLabel" 
			aria-hidden		=	"true" 
			id				=	"fullSize">

	  <div class="modal-dialog modal-md">

	    <div class="modal-content">

	      <div class="modal-header">
	        <button type		=	"button" 
	        		class		=	"close" 
	        		data-dismiss=	"modal">

	        	<span aria-hidden="true">&times;</span>
	        	<span class="sr-only">Close</span>
	        </button>

	        <h5 class	=	"modal-title fontNormal middle smallTitles" 
	        	id		=	"imageLabel">
	        	{{$datos['post']->refaccion()->first()->Nombre}}
	        </h5>

	      </div>

	      <div class="modal-body">

	      		<div id="imgContainer">
					<img src="" id='imageFull' width ='100%'>
	      		</div>
	      		

	      </div>

	    </div>

	  </div>

	</div>

	<!-- modal de carrusel de imagenes -->
	<div 	class	 		=	"modal fade" 
			tabindex 		=	"-1" 
			role	 		=	"dialog" 
			aria-labelledby	=	"LargeModalLabel" 
			aria-hidden		=	"true" 
			id				=	"carrusel">

	  <div class="modal-dialog modal-sm">

	    <div class="modal-content">

	      <div class="modal-header">
	        <button type 			=	"button" 
	        		class			=	"close" 
	        		data-dismiss	=	"modal">

	        	<span aria-hidden="true">&times;</span>
	        	<span class="sr-only">Close</span>

	        </button>

	        <h5 class	=	"modal-title fontNormal middle smallTitles"
	        	id		=	"imageLabel">
	        	Imagenes de oferta
	        </h5>

	      </div>

	      <div class="modal-body">

	      		 <div id="imagesOffer" class="carousel slide">
			    
			      <!-- Carousel items -->
			      <div class="carousel-inner">
			        
			       
			      </div>
			      <!-- Carousel nav -->
			      <a class="carousel-control left" href="#imagesOffer" data-slide="prev">&lsaquo;</a>
			      <a class="carousel-control right" href="#imagesOffer" data-slide="next">&rsaquo;</a>
			    </div>

	      </div>

	    </div>

	  </div>

	</div>



	
@stop

@section('scripts')

	{!! HTML::script('/js/vendors/areas.js')!!}
	{!! HTML::script('/js/Comprador/ofertas.js')!!}


@stop