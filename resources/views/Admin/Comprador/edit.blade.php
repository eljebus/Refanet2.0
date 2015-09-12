@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/nueva.css') !!}



@stop


@section('pre-content')
	
				


	
@stop


@section('content')


	<h3 class='mediumTitles fontNormal'>
		Editar publicación {{$datos['publicacion']->refaccion()
													->first()
													->Nombre}} 
	</h3>

	<section id="registerForm" class='contentCenter'>
			{!! Form::open(array(	'url' 	=> 	'/Comprador/SaveEdit',
									'id'	=>	'articleForm', 
									'files' => 	true, 
									'method'=>	'POST')) !!}
				
				<div id="izquierda">

					<input 	type		=	"text" 
							class		=	"form-control login-field" 
							value		=	"{{$datos['publicacion']->refaccion()
																->first()
																->Nombre}}" 
							placeholder	=	"Nombre de la Pieza" 
							name 		= 	'name' 
							required
					>


					<input 	type		=	"hidden" 
							value		=	"{{$datos['publicacion']->refaccion()
																->first()
																->idRefaccion}}" 
							name		=	'id'>


					<select name		=	"marck" 
							class		=	"form-control login-field" 
							required>


						@foreach ($datos['publicacion']->categoria()
														->first()
														->marcas()
														->get() as $marca )
						    
						    <option value="{{$marca->idMarca}}">
						    	{{$marca->Nombre}}
						    </option>
						    
						@endforeach
						
					</select>

					<input 	type		=	"text" 
							class		=	"form-control login-field" 
							value		=	"{{$datos['publicacion']->refaccion()
																	->first()
																	->Tipo}}" 
							placeholder	=	"Tipo del Vehículo"  
							name		= 	'type' 
							required
					>

					<input 	type		=	"text" 
							class		=	"form-control login-field" 
							value		=	"{{$datos['publicacion']->refaccion()
																	->first()
																	->Modelo}}" 
							placeholder	=	"Modelo de la Vehículo" 
							name 		= 	'model' 
							required
					>

					<button type 		= 	"button" 
							class 		= 	"btn btn-danger btn-xs" 
							data-toggle = 	"modal" 
							data-target = 	"#danger">
							Eliminar Publicación
					</button>


				</div>

				<div id="derecha">
					<ul class='images list-none' id='itemContainer'>

						<li id='plusImage' class='fontNormal white'>
				          	<span class="icon-plus"></span> 
				          	<br>Imagenes
				          	<br> 1Mb / imagen 
			
					        <input type="file" name="files[]" id='add-imagen'multiple='true' >

						</li>
						<?php $contador=0; ?> 

							@foreach($datos['publicacion']->refaccion()
															->first()
															->galeria()
															->where('Status','=',1)
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
					
		
			        <textarea class="form-control" placeholder='Detalles adicionales de la pieza' name = 'description' required>{{$datos['publicacion']->refaccion()->first()->Descripcion}}</textarea>
			       
			      

			        <button type="submit" class="btn btn-success btn-block" id='button'>

		            	Continuar
		            </button>

				</div>
	         

			{!! Form::close() !!}



		</section>

		<div 	class			=	"modal fade -modal-sm" 
				tabindex		=	"-1" 
				role			=	"dialog" 
				aria-labelledby	=	"mySmallModalLabel"
		>

		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      ...
		    </div>
		  </div>
		</div>

		<div class="modal fade bs-example-modal-sm" id='danger'>
		  <div class="modal-dialog modal-sm">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type			=	"button" 
		        		class			=	"close" 
		        		data-dismiss	=	"modal" 
		        		aria-label		=	"Close"
		        >

	        	<span aria-hidden="true">&times;</span></button>

	        	<h4 class="modal-title">Cuidado</h4>

		      </div>
		      <div class="modal-body">
		        <p>
		        	Estas apunto de eliminar 
		        	<strong>
		        		<i>{{$datos['publicacion']->refaccion()->first()->Nombre}}</i>
		        	</strong>, 
		        	estas seguro de querer hacerlo?

		        </p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-default ">


		        	<a href="/Comprador/deleteItem/{{$datos['publicacion']->idPublicacion}}">
		        		Si, estoy seguro
		        	</a>
		        	
		        </button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
@stop

@section('scripts')

	{!! HTML::script('/js/vendors/editImages.js')!!}
	
	<script>
		contador = {{$contador}};
	</script>		
	{!! HTML::script('/js/Comprador/edit.js')!!}


@stop