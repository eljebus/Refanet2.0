@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/nueva.css') !!}



@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	<h3 class='mediumTitles fontNormal'>Nueva Publicación</h3>

	<section id="registerForm" class='contentCenter'>
			{!! Form::open(array(	'url' 	=> 	'/Registro/Comprador/finalizar',
									'id'	=>	'articleForm', 
									'files' => true, 
									'method'=>'POST')) !!}
				
				<div id="izquierda">
					<input type="text" class="form-control login-field" value="" placeholder="Nombre de la Pieza" name = 'name' required>

					<select name="category" id="category" class='form-control login-field'>

						<option value="" id='cRemove'>Categorias</option>
						
						@foreach($datos['categorias'] as $categoria)
							
							<option value="{{$categoria->idCategoria}}">
								Categoría {{$categoria->Nombre}}
							</option>

						@endforeach

					</select>

					<select name="marck" class="form-control login-field" id='marck' required>
						

						<option value="">
							Marcas
						</option>
						
					</select>

					<input type="text" class="form-control login-field" value="" placeholder="Tipo del Vehículo"  name = 'type' required>

					<input type="text" class="form-control login-field" value="" placeholder="Modelo de la Vehículo" name = 'model' required>


				</div>

				<div id="derecha">
					<ul class='images list-none' id='itemContainer'>

						<li id='plusImage' class='fontNormal white'>
				          	<span class="icon-plus"></span> 
				          	<br>Imagenes
				          	<br> 1Mb / imagen 
			
					        <input type="file" name="files[]" id='add-imagen'
					        multiple='true' >

						</li>

					</ul>
					
		
			        <textarea class="form-control" placeholder='Detalles adicionales de la pieza' name = 'description' required></textarea>
			       
			      
			        <button type="submit" class="btn btn-success btn-block" id='button'>

		            	Continuar
		            </button>

				</div>
	         

			{!! Form::close() !!}



		</section>
	
@stop

@section('scripts')

	{!! HTML::script('/js/vendors/uploadImages.js')!!}
	{!! HTML::script('/js/vendors/uploadNew.js')!!}

	{!! HTML::script('/js/Comprador/nueva.js')!!}


@stop