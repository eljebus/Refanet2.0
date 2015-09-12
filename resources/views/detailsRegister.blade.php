@extends('layout')


@section('styles')

		{!! HTML::style('/css/detallesRegistro.css') !!}

@stop


@section('pre-content')



	
@stop


@section('content')

		<div class='bg-gray'>
			<ul class='list-none contentCenter' id='etapas'>
				<li class='itemInactive'>

					<span class="itemCircle  white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Registrarme</p>

				</li>

				<li class='itemActive'>

					<span class="itemCircle white inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Detalles de la Pieza</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">3</span>
					<p class='inline vmedio bottom-none'>Publicar Refacción</p>

				</li>

			</ul>
			
		</div>

		<section id="registerForm" class='contentCenter'>
			<br>
			{!! Form::open(array('url' => '/Registro/Comprador/finalizar','id'=>'articleForm', 'files' => true, 'method'=>'POST')) !!}
				
				<div id="izquierda">
					<input type="text" class="form-control login-field" value="" placeholder="Nombre de la Pieza" name = 'name' required>


					<select name="category" id="category">
						
						@foreach($categoria['categorias'] as $categoria)
							
							<option value="{{$categoria->idCategoria}}">
								{{$categoria->Nombre}}
							</option>

						@endforeach

					</select>



					<select name="marck" class="form-control login-field" required>


						@foreach ($categoria['categoria']->marcas()->get() as $marca )
						    
						    <option value="{{$marca->idMarca}}">{{$marca->Nombre}}</option>
						    
						@endforeach
						
					</select>

					<input type="text" class="form-control login-field" value="" placeholder="Tipo del Vehículo"  name = 'type' required>

					<input type="text" class="form-control login-field" value="" placeholder="Modelo de la Vehículo" name = 'model' required>


		              <label>
						  <input type="checkbox" name="quux[1]" class ='check' required>

						  	<a href="/terminos">
							  Acepto los terminos y condiciones
							</a>
						</label>
		   
				</div>

				<div id="derecha">
					<ul class='images list-none' id='itemContainer'>

						<li id='plusImage' class='fontNormal white'>
				          	<span class="icon-plus"></span> 
				          	<br>Imagenes
				          	<br> 1Mb / imagen 
			
					        <input type="file" name="files[]" id='add-imagen' multiple='true' >

						</li>

					</ul>
					
		
			        <textarea class="form-control" placeholder='Detalles adicionales de la pieza' name = 'description' required></textarea>
			       
			      

			        <button type="submit" class="btn btn-success btn-block" id='send'>

		            	Continuar
		            </button>

				</div>
	         

			{!! Form::close() !!}


		</section>




@stop

@section('scripts')

	{!! HTML::script('/js/vendors/uploadImages.js')!!}
	{!! HTML::script('/js/vendors/uploadNew.js')!!}

	{!! HTML::script('/js/detalles.js')!!}




@stop