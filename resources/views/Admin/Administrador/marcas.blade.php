@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/marcas.css') !!}

@stop




@section('content')

	<a href='/Administrador/NuevaMarca/' class='thumbnail' id='new'>
		<span class="glyphicon glyphicon-plus-sign"></span>
		Nueva Marca
	</a>

	<div class="panel panel-default" id='lista'>

	  <div class="panel-heading">

	  	<ul class='list-none'>
	  		<li class='ref'>
	  			Referencia
	  		</li>

	  		<li class="name">
	  			Nombre
	  		</li>

	  		<li class="cat">
	  			Categoria
	  		</li>


	  		<li class="deleteItem">
	  			Eliminar
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">

		@foreach ($datos['marcas'] as $marca)

		  	<tr>
		  		<td class='ref'>	
		  			{{$marca->idMarca}}
		  		</td>

		  		<td class='name'>
		  			{{$marca->Nombre}}
		  		</td>

		  		<td class='cat'>
		  			@foreach ($marca->categoria as $categoria)
		  				{{$categoria->Nombre}},
		  			@endforeach
		  			
		  		</td>


		  		<td class='deleteItem'>
		  			<a href="/Administrador/deleteMarck/{{$marca->idMarca}}">
		  				<span 	class	=	"glyphicon glyphicon-remove" 
		  						data-id	=	'{{$marca->idMarca}}'></span>
		  			</a>
		  		</td>
		  	</tr>

		@endforeach



	  </table>
	</div>

	<center>

		{{$datos['marcas']->render()}}	

	</center>
	
	

	
	
@stop