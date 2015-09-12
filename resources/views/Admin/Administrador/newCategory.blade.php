@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/newCategory.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')



	<h3> Nueva Categoría</h3>

	{!! Form::open(array('url' =>'/Administrador/newC','method'=>'POST', 'files' => true)) !!}

		
		<div class='izquierda'>

			{!!Form::text('nombre', 
						$value = null, 
						$attributes = array('placeholder'	=>	'Nombre de la categoría',
											'required'		=>	'required', 
											'class'			=>	'form-control login-field'))!!}

			
			<button type="submit" class="btn btn-success btn-block">

            	Registrar
            	
            </button>
			
		</div>

		<!--<div class="derecha">

			{!!Form::textarea(	'descripcion', $value = null, 
								$attributes = array('placeholder'=>'Descripción',
								'required'=>'required',
								'id'=>'texto','class'=>'form-control'))!!}
			

		</div>-->


	{!! Form::close() !!}
	
	

	
	
@stop

@section('scripts')

	{{ HTML::script('/js/vendors/uploadImages.js')}}

	{{ HTML::script('/js/Administrador/marca.js')}}


@stop