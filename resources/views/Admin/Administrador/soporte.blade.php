@extends('Admin/Administrador/layout')


@section('styles')

			{!! HTML::style('/css/Admin/Administrador/compras.css') !!} 

@stop


@section('pre-content')
	
				


	
@stop


@section('content')



	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='np'>
	  			Referencia
	  		</li>

	  		<li class="name">
	  			Titulo de la Pregunta
	  		</li>

	  		<li class="date">
	  			Fecha
	  		</li>

	  		<li class="type">
	  			Departamento
	  		</li>

	  		<li class="status">
	  			Usuario
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">

	  	@foreach($datos['tickets'] as $ticket)

		  	<tr>
		  		<td class='np'>	
		  			{{$ticket->idTicket}}
		  		</td>

		  		<td class='name'>
		  			<a href="/Administrador/Pregunta/{{$ticket->idTicket}}">
			  			{{$ticket->Asunto}}
			  		</a>
		  		</td>

		  		<td class='date'>
		  			{{$ticket->Fecha}}
		  		</td>

		  		<td class='type'>
		  			{{$ticket->Departamento}}
		  		</td>

		  		<td class='type'>
		  			{{$ticket->usuario()->first()->Nombre}}
		  		</td>


		  	</tr>


		@endforeach
	  	
	  </table>
	</div>

	<center>
	
	{{$datos['tickets']->render()}}

	</center>
	


	
	
@stop