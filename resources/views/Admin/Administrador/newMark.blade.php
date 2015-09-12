@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/newMark.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')



	<h3> Nueva Marca</h3>



	{!! Form::open(array('url' 		=>'/Administrador/newM',
						'method'	=>'POST', 
						'files' 	=> true,
						'id'=>'new')) !!}
		
		<div class='izquierda'>

			{!!Form::text('nombre', $value = null, $attributes = array('placeholder'=>'Nombre de la Marca','required'=>'required', 'class'=>'form-control login-field'))!!}

			<select name="categoria[]" class='form-control' required multiple>

				@foreach ($datos['categorias'] as $categoria)

					<option value="{{$categoria->idCategoria}}">{{$categoria->Nombre}}</option>

				@endforeach
			</select>

			
			<button type="submit" class="btn btn-success btn-block">

		        Registrar

		    </button>
			
		</div>

		<!--<div class="derecha">

			{!!Form::textarea('descripcion', 
								$value = null, 
								$attributes = array('placeholder'=>'Descripción',
													'required'=>'required',
													'id'=>'texto',
													'class'=>'form-control'))!!}

			<button type="submit" class="btn btn-success btn-block">

		        Registrar

		    </button>
		</div>-->
	{!! Form::close() !!}
	
	

	
	
@stop

@section('scripts')

	{!! HTML::script('/js/vendors/uploadImages.js')!!}
	{!! HTML::script('/js/vendors/uploadNew.js')!!}

	{!! HTML::script('/js/Administrador/marca.js')!!}


@stop