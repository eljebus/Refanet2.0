@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/perfil.css') !!}

@stop


@section('pre-content')
	
	<section class='contentCenter' id='subNavNew'>

		<ul class='list-none'>
			<li id='index'>
				<a href="/Comprador/perfil" title="">
					<span class='glyphicon glyphicon-user'></span>
					Mi Cuenta
				</a>
			</li>


			<li id='soporte'>
				<a href="/Comprador" title="">
					<span class='glyphicon glyphicon-wrench'></span>
					Mis Publicaciones
				</a>
			</li>

			<li class='search'>

				<div class="form-group">
		        	<input type="text" value="" placeholder="Buscar Publicación" class="form-control">
		        
	        	</div>
			</li>


		</ul>
		
	</section>
	
@stop


@section('content')


	{!! Form::open(array(	'id'	=>'profileForm',
							'method'=>'POST',
							'url'	=> '/Comprador/saveProfile',
							'class'=>'contentCenter',
							'files'=>true)) !!}

		<div class="izquierda floatLeft">
			
			<div class="input-group perfil">
	          <span class="input-group-addon">
	          	<span class="glyphicon glyphicon-user"></span>
	          </span>
	          <input type="text" class="form-control" placeholder='Nombre Completo' value="{{$dataUser['userName']}}" name='Nombre' required>
	        </div>


			<div class="form-group">

				<input type="password" class="form-control login-field"  placeholder="Nuevo password" id="login-name" value="valor de prueba" name='Clave'>


				<select class="form-control inline doble" name='Estado'>
					<option value="{{$dataUser['user']->Estado}}" selected>{{$dataUser['user']->Estado}}</option>
					
					<option value="Aguascalientes">Aguascalientes</option>
					<option value="Baja California">Baja California</option>
					<option value="Baja California Sur">Baja California Sur</option>
					<option value="Campeche">Campeche</option>
					<option value="Chiapas">Chiapas</option>
					<option value="Chihuahua">Chihuahua</option>
					<option value="Coahuila">Coahuila</option>
					<option value="Colima">Colima</option>
					<option value="Distrito Federal">Distrito Federal</option>
					<option value="Durango">Durango</option>
					<option value="Estado de México">Estado de México</option>
					<option value="Guanajuato">Guanajuato</option>
					<option value="Guerrero">Guerrero</option>
					<option value="Hidalgo">Hidalgo</option>
					<option value="Jalisco">Jalisco</option>
					<option value="Michoacán">Michoacán</option>
					<option value="Morelos">Morelos</option>
					<option value="Nayarit">Nayarit</option>
					<option value="Nuevo León">Nuevo León</option>
					<option value="Oaxaca">Oaxaca</option>
					<option value="Puebla">Puebla</option>
					<option value="Querétaro">Querétaro</option>
					<option value="Quintana Roo">Quintana Roo</option>
					<option value="San Luis Potosí">San Luis Potosí</option>
					<option value="Sinaloa">Sinaloa</option>
					<option value="Sonora">Sonora</option>
					<option value="Tabasco">Tabasco</option>
					<option value="Tamaulipas">Tamaulipas</option>
					<option value="Tlaxcala">Tlaxcala</option>
					<option value="Veracruz">Veracruz</option>
					<option value="Yucatán">Yucatán</option>
					<option value="Zacatecas">Zacatecas</option>
				</select>

				<input type="text" class="form-control inline doble ultimo" value="{{$dataUser['user']->Municipio}}" placeholder="Municipio" name='Municipio' >


				<input type="text" class="form-control login-field" value="{{$dataUser['user']->Domicilio}} " placeholder="Dirección" name='Domicilio'  >

				<input type="text" class="form-control inline doble" value="{{$dataUser['user']->Cp}}" placeholder="Codigo Postal" name='Cp' >

				<input type="tel" class="form-control inline doble ultimo" value="{{$dataUser['user']->Tel}}" placeholder="telefono" name='Telefono'>

				<input type="email" class="form-control " value="{{$dataUser['user']->Mail}}" placeholder="Correo Electónico" name='Mail' required>

				<button type="submit" class="btn btn-success btn-block">
					Guardar cambios
		        </button>

	


	    	</div>

		</div>

		<div class="derecha floatRight">
			<div class="form-group">
				<img src="{{$dataUser['user']->Avatar}}" id='avatar'>

				<div id="imagen" class='verde'>

					Cambiar Foto de Perfil

					<input type="file" class="form-control " value="jesuscervantes82@hotmail.com" name='avatar' id='avatarInput'>

				</div>	

				<br>
				<span>
					
					Total de publicaciones: {{$dataUser['user']->publicaciones()
															->where('Status','!=',0)
															->count()}} 

				</span>
				
			</div>
		</div>

	{!! Form::close() !!}


	<div id='reputacion'class='contentCenter'>
		
		<h3>Reputación</h3>

		<div id="note">

			<?php $calificacion =   round($dataUser['user']->reputacion()->avg('Calificacion'), 0, PHP_ROUND_HALF_UP); ?>

			@for($i=1;$i <=$calificacion;$i++)

  				<span class="glyphicon glyphicon-star inline goodNote"></span>
  		
  			@endfor

  			@for($i=1;$i <=(5 - $calificacion);$i++)

				<span class="glyphicon glyphicon-star inline"></span>

  			@endfor
  		</div>
		
		<br>

		<p>Últimos comentarios</p>

  		<ul class="list-group">

	  		@foreach($dataUser['user']->reputacion()
	  									->orderBy('id','DESC')
	  									->limit(5)
	  									->get() as $comentario)

			  <li class="list-group-item">

			  	{{$comentario->Comentario}}

			  </li>
	
			
			@endforeach


		</ul>



	</div>


	
@stop

@section('scripts')
	
	{!! HTML::script('/js/Comprador/avatar.js')!!}


@stop