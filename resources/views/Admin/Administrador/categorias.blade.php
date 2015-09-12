@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/categorias.css') !!}

@stop


@section('pre-content')
	
				

	
@stop


@section('content')


<a href='/Administrador/NuevaCategoria' class='thumbnail' id='new'>
		<span class="glyphicon glyphicon-plus-sign"></span>
		Nueva Categoría
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

	  		<li class="description">
	  			Descripción
	  		</li>

	  		<li class="deleteItem">
	  			Eliminar
	  		</li>
	  	</ul>


	  </div>


	  <table class="table">

  		@foreach ($datos['categorias'] as $categoria)
				
			<tr>
		  		<td class='ref'>	
		  			{{$categoria->idCategoria}}
		  		</td>

		  		<td class='name'>
		  			{{$categoria->Nombre}}
		  		</td>

		  
		  		<td class='description'>
		  			{{$categoria->Descripcion}}
		  		</td>

		  		<td class='deleteItem'>

		  			<a href="/Administrador/deleteCategory/{{$categoria->idCategoria}}">
			  			<span class="glyphicon glyphicon-remove"></span>
			  		</a>
		  		</td>
		  	</tr>

		@endforeach

	  


	  </table>
	</div>

	<center>
		{{$datos['categorias']->render()}}	

	</center>

	
	

	
	
@stop