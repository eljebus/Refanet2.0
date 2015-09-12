@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/coments.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	
	<?php $bandera = false; ?>


	@if($datos['post']->Status > 1 )

		<?php $bandera = true; ?>

	@endif


	<section id="imagenes">

	
		<aside class="izquierda inline">

			<ul class="list-none">



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

			<?PHP $refaccion  = $datos['post']->refaccion()->first(); ?>

			<h2 class="bigTitles textNormal fontNormal top-none orange">
				{{$refaccion->Nombre}}
			</h2>

			<br>

			<span class="avatar inline vmedio">
	  			<img src="{{$datos['post']->usuario()->first()->Avatar}}" alt="">
	  		</span>

	  		<span class="inline name vmedio profile" data-idprofile="1">
	  			 &nbsp;{{$datos['post']->usuario()->first()->Nombre}}

	  		</span>

	  		<br>
	  		<br>
			<span class='marca fontNormal textBold inline'>
				{{$refaccion->marca()->first()->Nombre}}
			</span>
			<span class='categoria fontNormal textBold inline'>
				{{$datos['post']->categoria()->first()->Nombre}}
			</span>
			<br>
			<span class='tipo fontNormal textBold inline'>
				Tipo {{$refaccion->Tipo}}
			</span>
			<span class='modelo fontNormal textBold inline'>
				Modelo {{$refaccion->Modelo}}
			</span>
			
			
			<article class='fontNormal'>
				<span class='verde'> Descripción</span>
				<br>
				
				{{$refaccion->Descripcion}}
				
			</article>

		</aside>



	</section>

	<ul class="list-group fontNormal offers ">


		
	
		<?php $oferta =  $datos['oferta']; ?>
		


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
					<span class="floatRight">
						Referencia {{$oferta->idOferta}}
					</span>

				</div>	

				<article class='description'>
					
					{{$oferta->refaccion()->first()->Descripcion}}
						/
					<i><strong><small>Se entrega en {{$oferta->TiempoE}}</small></strong></i>
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
															->where("Status","=","1")
															->get() as $photo)
															{{$photo->Archivo}}[photo]@endforeach'>

						<span class="glyphicon glyphicon-picture"></span>
						&nbsp;
						Fotos ({{$oferta->refaccion()->first()
													 ->galeria()
													 ->where('Status','=','1')
													 ->count()}})
					</span>
					
					@if($bandera === false)
						<a 	href 	=	"/Vendedor/EditarOferta/{{$oferta->idOferta}}"
							class	=	"btn btn-success inline buy"
							id		= 	"modify">
					
							Modificar Oferta

						</a>
					@else
								&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
							<small>Oferta finalizada</small>
						
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

	      		<span class="avatar  vmedio">
		  			<img src="/images/avatar.jpg" alt="">
		  		</span>
		  		<br>
		  		<h7 class='orange'>
		  			{{$oferta->publicacion()->first()
						 				->usuario()
						 				->first()
						 				->Nombre}}
		  		</h7>
		  		<br>
		  		<br>
		  		<div id="note">

		  			<?php $calificacion =   round($oferta->publicacion()
		  												->first()
						 								->usuario()
						 								->first()
													   	->reputacion()
													   	->avg('Calificacion'), 0, PHP_ROUND_HALF_UP); ?>

					@for($i=1;$i <=$calificacion;$i++)

		  				<span class="glyphicon glyphicon-star inline goodNote"></span>
		  		
		  			@endfor

		  			@for($i=1;$i <=(5 - $calificacion);$i++)

						<span class="glyphicon glyphicon-star inline"></span>

		  			@endfor
		  		</div>
		  		<p class='fontNormal'>
		  			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 

		  		</p>

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
	{!! HTML::script('/js/Vendedor/oferta.js')!!}


@stop