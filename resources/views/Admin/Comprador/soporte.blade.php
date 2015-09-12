@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/soporte.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')

	<div id='faqs'>

		<a href="" title="">
			<span class="glyphicon glyphicon-list-alt"></span> Tutoriales
		</a>

	</div>

	<section id="ticket">

		{!! Form::open(array('url' => 'Comprador/preguntar','id'=>'contactForm','method' => 'post')) !!}

			<h5 class='orange title textNormal mediumTitles'>Nueva Pregunta</h5>

		
		    <select class="form-control inline" required name='Departamento'>
		      <option>Ventas</option>
		      <option>Soporte</option>
		      <option>Renovaciones</option>
		      <option>Reportes</option>
		    </select>

        	
	        <input type="text" value="" placeholder="Titulo de la Pregunta" class="form-control inline titleQuestion" required name='Titulo'>
 
        	<textarea class="form-control" rows="7" placeholder='Escribe aqui detalladamente tu pregunta o comentario' required name='Contenido'></textarea>

        	<button type="submit" class="btn btn-success btn-block">

            	Enviar Pregunta
            </button>


		{!! Form::close() !!}

	</section>


	
	
@stop