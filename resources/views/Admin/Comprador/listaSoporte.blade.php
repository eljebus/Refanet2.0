@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/listaSoporte.css') !!}
		<style>

			#faqs .nueva{

				width 		: 200px;
				margin-top 	: 0;
				overflow 	: hidden;
			}
			
		</style>

		

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	
	<br>

	<div id='faqs'>


		<a href="" title="" class='inline vmedio'>
			<span class="glyphicon glyphicon-list-alt"></span> Tutoriales
		</a>

		<a href='/Comprador/Soporte/Nueva' class='nueva floatRight btn btn-success btn-block'>
			Nueva Pregunta
		</a>

	</div>
	<br>
	<br>

	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='np'>
	  			Ref
	  		</li>

	  		<li class="name">
	  			Titulo de la Pregunta
	  		</li>

	  		<li class="date">
	  			Fecha
	  		</li>
	  		<li class='date'>
	  			Departamento
	  			
	  		</li>

	  		<li class="status">
	  			Estado
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">


				
		@if( $datos['ticket']->count() === 0 )
			
			<tr>
				
				<td>
					
					No haz abierto ningun ticket
					
				</td>
			</tr>

			
		@endif



		@foreach ($datos['ticket'] as $ticket)

		  	
			  	<tr>
			  		<td class='np'>	
			  			{{$ticket->idTicket}}
			  		</td>

			  		<td class='name'>

			  			<a href="/Comprador/Pregunta/{{$ticket->idTicket}}">
				  			{{$ticket->Asunto}}
				  		</a>
			  		</td>

			  		<td class='date'>
			  			{{$ticket->Fecha}}
			  		</td>
			  		<td>
			  			
			  			{{$ticket->Departamento}}
			  		</td>

			  		<td class='status'>
			  			{{$ticket->Status}}
			  		</td>
			  	</tr>
	

		@endforeach


	  	
	  	
	  </table>
	</div>

	
	<center>
		

		  {!! $datos['ticket']->render() !!}

	</center>
	
	
	
@stop