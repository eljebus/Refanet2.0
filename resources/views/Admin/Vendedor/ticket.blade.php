@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/soporte.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')

	
	<div class="panel panel-default" id="lista">

	  <div class="panel-heading">


	  		<span class='orange'>{{$datos['ticket']->Asunto}} </span> 
	  		<span class="floatRight">
	  			Pregunta {{$datos['ticket']->idTicket}} / {{$datos['ticket']->Departamento}} 
	  		</span>



	  </div>


	  <ul class="list-group fontNormal offers">


	  	<li id='newComent'>

		  	<div class="newComent extra" style="height: auto; margin-top: 1em;">

		  		<span class="avatar inline">
		  			<img src="{{$dataUser['user']->Avatar}}">
		  		</span>
		  		
		  		<textarea 	class			=	"form-control inline commentContent" 
		  					placeholder		=	"Escribe aquí tu comentario" 
		  					required 
		  					id				=	"area2" 
		  					data-idticket	=	"{{$datos['ticket']->idTicket}}"></textarea>

		  	</div>


		  </li>

		@foreach($datos['ticket']->preguntas()->orderBy('idPregunta','DESC')->get() as $pregunta)
		  
		  <li class="list-group-item">


		  	<span class="verde textBold ">{{$pregunta->usuario()->first()->Nombre}}: </span>

		  	{{$pregunta->Contenido}}


		  </li>

		@endforeach

		  
		</ul>
	</div>
	
	
@stop

@section('scripts')
	
	<script>
		var usuario = "{{$dataUser['user']->Nombre}}";
	</script>
	{!! HTML::script('/js/vendors/areas.js')!!}
	{!! HTML::script('/js/Vendedor/preguntas.js')!!}


	
@stop