@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/post.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	

	<section id="imagenes">

	
		<aside class="izquierda inline">

			<ul class="list-none">
				<?php $refaccion  =  $datos['pieza']->refaccion()->first(); ?>

				

				@foreach($refaccion->galeria()->get() as $photo)

					<li>


						<img src="{{$photo->Archivo}}" alt="">

						<span 	class 		= "glyphicon glyphicon-resize-full fullSize bg-blue white" 
								data-toggle	= "modal" 
								data-target = "#fullSize" 
								data-title 	= 'Marcha Mecanica'></span>
					</li>

				@endforeach

				
				
			</ul>

		</aside>

		<aside class="derecha inline">

			<h2 class="bigTitles textNormal fontNormal top-none orange">{{$refaccion->Nombre}}</h2>
			<br>

			<span class="avatar inline vmedio">
	  			<img src="{{$datos['pieza']->usuario()->first()->Avatar}}" alt="">
	  		</span>

	  		<span class="inline name vmedio profile" data-idprofile="1">
	  			 &nbsp;{{$datos['pieza']->usuario()->first()->Nombre}}

	  		</span>

	  		<br>
	  		<br>
			<span class='marca fontNormal textBold inline'>
				{{$refaccion->marca()->first()->Nombre}}
			</span>
			<span class='categoria fontNormal textBold inline'>
				{{$datos['pieza']->categoria()->first()->Nombre}}
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


	<section id="ofertar">

		@if(array_key_exists('oferta',$datos))


			<?php $oferta =  $datos['oferta']; ?>

			{!! Form::open(array(	'url' 	=> 	'/Vendedor/ofertar',
									'id'	=>	'offerForm',
									'files' => 	true,
									'method'=>	'POST')) !!}

				<div class="floatLeft">
					<input 	type	=	"hidden" 
							name	=	'oferta' 
							value	=	'{{$oferta->idOferta}}'>


					<div class="form-group price inline vtop">

						<span class="glyphicon glyphicon-usd inline verde vmedio"></span>
				        <input 	type		=	"text" 
				        		class		=	"form-control login-field inline vmedio" 
				        		value		=	"{{$oferta->Precio}}" 
				        		placeholder	=	"Precio de la pieza" 
				        		id			=	"login-name" 
				        		name		=	'Precio'
				        		required>
				    </div>

					

				    <div class="inline status">
				    	<select name="Estado"class='form-control bottom-none'>

				    		<?php

		
								switch ($oferta->Estado) {
								
									case 'A':
										print('<option value="A">Nueva</option>');
										break;

									case 'B':
										print('<option value="B">Genérica</option>');
										break;

									default:
										print('<option value="C">Usada</option>');
										break;
								}


							?>

				    		<option value="A">Nueva</option>
				    		<option value="B">Genérica</option>
				    		<option value="C">Usada</option>
			
				    	</select>
				    </div>

				    <ul class	=	'images list-none' 
				    	id		=	'itemContainer'>

						<li id='plusImage' class='fontNormal white'>
				          	<span class="icon-plus"></span> 
				          	<br>Imagenes
			
					        <input 	type	 =	"file" 
					        		name	 =	"files[]" 
					        		id		 =	'add-imagen'
					        		multiple =	'true' 
					        		>

						</li>

						<?php $contador=0; ?> 

						@foreach($oferta->refaccion()
										->first()
										->galeria()
										->where('Status','=','1')
										->get() as $foto)
							
							<li class="item" >

								<img 	src 	= 	"{{$foto->Archivo}}" alt="{{$foto->Nombre}}">

								<span 	class 	= 	"icon-cancel-circle rojo delete editDelete" 
										data-id = 	'{{$foto->idGaleria}}'>
								</span>

							</li>

							<?php $contador++; ?>

						@endforeach

					</ul>



				</div>
				<div class="floatRight">
					<div class="form-group time inline vtop">

						<span class="glyphicon glyphicon-dashboard inline verde vmedio"></span>

				        <input 	type		=	"text" 
				        		class		=	"form-control  inline vmedio" 
				        		value		=	"{{$oferta->TiempoE}}" 
				        		placeholder	=	"Tiempo aprox. de entrega"  
				        		name		=	"time"
				        		required>
				    </div>

					 <div class='details inline vtop'>
				    	<span class="glyphicon glyphicon-comment inline verde vtop"></span>

				    	<textarea 	class		="form-control inline commentContent vmedio"  
				    				placeholder	='Descripción detallada' 
				    				required  
				    				id			='area2'
				    				name		='detalles'>{{$oferta->refaccion()->first()->Descripcion}}</textarea>

				    </div>
				    <button type="submit" 
				    		class="btn btn-success btn-block floatRight" 
				    		id='buttonModify' > 

				    	Guardar Cambios

				    </button>

				    
				</div>
			   
			     

			{!! Form::close() !!}


			
		@else

			{!! Form::open(array('url' => '/Vendedor/ofertar','id'=>'offerForm','files' => true,'method'=>'POST')) !!}

				<div class="floatLeft">
					<div class="form-group price inline vtop">

						<span class="glyphicon glyphicon-usd inline verde vmedio"></span>
				        <input 	type		=	"text" 
				        		class		=	"form-control login-field inline vmedio" 
				        		value		=	"" 
				        		placeholder	=	"Precio de la pieza" 
				        		id			=	"login-name" 
				        		name		=	'Precio'
				        		required>
				    </div>



				    <input type="hidden" name='idPieza' value="{{$datos['pieza']->idPublicacion}}">
					
					<input type="hidden" name='Categoria' value="{{$datos['pieza']->categoria()->first()->idCategoria}}">

				    <div class="inline status">
				    	<select name="Estado"class='form-control bottom-none'>
				    		<option value="A">Nueva</option>
				    		<option value="B">Genérica</option>
				    		<option value="C">Usada</option>
			
				    	</select>
				    </div>

				    <ul class	=	'images list-none' 
				    	id		=	'itemContainer'>

						<li id='plusImage' class='fontNormal white'>
				          	<span class="icon-plus"></span> 
				          	<br>Imagenes
			
					        <input 	type	 =	"file" 
					        		name	 =	"files[]" 
					        		id		 =	'add-imagen'
					        		multiple =	'true' 
					        		>

						</li>

					</ul>



				</div>
				<div class="floatRight">
					<div class="form-group time inline vtop">

						<span class="glyphicon glyphicon-dashboard inline verde vmedio"></span>

				        <input 	type		=	"text" 
				        		class		=	"form-control  inline vmedio" 
				        		value		=	"" 
				        		placeholder	=	"Tiempo aprox. de entrega"  
				        		name		=	"time"
				        		required>
				    </div>

					 <div class='details inline vtop'>
				    	<span class="glyphicon glyphicon-comment inline verde vtop"></span>

				    	<textarea 	class		="form-control inline commentContent vmedio"  
				    				placeholder	='Descripción detallada' 
				    				required  
				    				id			='area2'
				    				name		='detalles'></textarea>

				    </div>
				    <button type="" class="btn btn-success btn-block floatRight" id='button' > Ofertar</button>

				    
				</div>
			   
			     

			{!! Form::close() !!}

		@endif

		

	</section>

	



	<!-- modal de imagen tamaño reputacion -->
	<div 	class			=	"modal fade" 
			tabindex		=	"-1" 
			role			=	"dialog" 
			aria-labelledby	=	"LargeModalLabel" 
			aria-hidden		=	"true" 
			id				=	"perfil">

	  <div class="modal-dialog modal-sm">

	    <div class="modal-content">

	      <div class="modal-header">
	        
	        <button type="button" class="close" data-dismiss="modal">
	        	<span aria-hidden="true">&times;</span>
	        	<span class="sr-only">Close</span>
	        </button>

	        <h5 class="modal-title fontNormal middle smallTitles" id="imageLabel">
	        	Información del vendedor
	        </h5>

	      </div>

	      <div class="modal-body">

	      		<span class="avatar  vmedio reputacion">
		  			<img src="{{$datos['pieza']->usuario()->first()->Avatar}}" alt="">
		  		</span>
		  		<br>
		  		<h7 class='orange'>{{$datos['pieza']->usuario()->first()->Nombre}}</h7>
		  		<div id="note">

					<?php $calificacion =   round($datos['pieza']->usuario()
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
		  		<p>Últimos comentarios</p>

		  		<ul class="list-group">

			  		@foreach($datos['pieza']->usuario()
											  ->first()
											  ->reputacion()
			  								  ->limit(3)
			  								  ->get() as $comentario)

					  <li class="list-group-item">

					  	{{$comentario->Comentario}}

					  </li>
			
					
					@endforeach


				</ul>
	      </div>

	    </div>

	  </div>

	</div>
	
	<!-- modal de imagen tamaño completo -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="LargeModalLabel" aria-hidden="true" id="fullSize">

	  <div class="modal-dialog modal-md">

	    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h5 class="modal-title fontNormal middle smallTitles" id="imageLabel">Nombre</h5>
	      </div>

	      <div class="modal-body">

	      		<img src="" id='imageFull' width ='100%'>

	      </div>

	    </div>

	  </div>

	</div>

	<!-- modal de carrusel de imagenes -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="LargeModalLabel" aria-hidden="true" id="carrusel">

	  <div class="modal-dialog modal-sm">

	    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h5 class="modal-title fontNormal middle smallTitles" id="imageLabel">Imagenes de oferta</h5>
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

	@if(array_key_exists('oferta',$datos))


		{!! HTML::script('/js/vendors/editImages.js')!!}
	
		<script>
			contador = {{$contador}};
		</script>		

		{!! HTML::script('/js/Vendedor/edit.js')!!}

	@else

		{!! HTML::script('/js/vendors/uploadNew.js')!!}
		{!! HTML::script('/js/Vendedor/ofertar.js')!!}

	@endif

	{!! HTML::script('/js/Comprador/ofertas.js')!!}

@stop