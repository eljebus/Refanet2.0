@extends('layout')


@section('styles')

		{!! HTML::style('/css/registroSeller.css') !!}

@stop


@section('pre-content')



	
@stop


@section('content')

		<div class='bg-gray'>
			<ul class='list-none contentCenter' id='etapas'>
			<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Registrarme</p>

				</li>

				<li class='ItemActive'>

					<span class="itemCircle white  bg-blue  inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Suscripciones</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">3</span>
					<p class='inline vmedio bottom-none'>Método de Pago</p>

				</li>

				<li class='itemInactive'>

					<span class="itemCircle white inline vmedio ">4</span>
					<p class='inline vmedio bottom-none'>Todo Listo</p>

				</li>

			</ul>
			
		</div>

	

		<section id="registerForm" class='contentCenter'>

			<article class='fontNormal textBold'>

				Selecciona las acategorías para que recibas notificaciones y alertas en tu panel y tu correo, así como también las marcas que puedes vender
				
			</article>

			{!! Form::open(array(	'url' => '/Registro/Vendedor/Subscriptions',
									'method'=>'POST','id'=>'suscriptionForm')) !!}

			<div id='divContainer'>
				<div class="floatLeft categorys">

					<h3 class="fontNormal bigTitles orange">Categorías</h3>
					<br>
					<ul class="list-none checkboxList">
		
						@foreach( $datos['categorias']->get() as $categoria)
							<li>
								
								<input 	type 	= "checkbox"  
										class 	= 'checkCategory' 
										name 	= "categorias[]" 
										id 		= '{{$categoria->Nombre}}' 
										value 	= "{{$categoria->idCategoria}}"
										data-id = "{{$categoria->idCategoria}}"
										data-n 	= "{{$categoria->Nombre}}">


								<label for='{{$categoria->Nombre}}'> {{$categoria->Nombre}}</label>

							</li>
						@endforeach
						
					
				</div>
				<div class="floatRight marks">

					<h3 class="fontNormal bigTitles orange">Marcas</h3>
					<br>
					<ul class="list-none checkboxList" id='marcas'>
						
						<p id='relleno'>
							
							Selecciona una categoría
						</p>
						
					</ul>

						 
				
				</div>
				
			</div>
				
				<br>

				<input 	type	="submit" 
						class	='btn btn-success btn-block floatRight bg-verde' 
						name	="" 
						value	="Continuar">

			{!! Form::close() !!}


		</section>




@stop

@section('scripts')

<script>

	$(document).on('ready',iniciar);


	function iniciar(){

		$('.checkCategory').on('change',showMarks);

	}	



	function showMarks(){

		var bandera = false;

		var id 		= $(this).data('id');
		var name 	= $(this).data('n');


		 if(this.checked) 
		 	bandera = true;

		  $.ajax({

		       url : '/getMarcks/' + id,
		       type : 'GET',
		       headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
		       processData : false, 
		       contentType : false, 
		       success : function(res){
		       	
		         	showMarcks(bandera,
		         				res,
		         				id,
		         				name);
			        
			     }

		    });

	}


	function showMarcks(bandera,marcas,id,name){

			if(bandera === true){

				$('#relleno').remove();

				for ( marca in marcas){
			         	
			         	
			         $('#marcas').append("<li id='"+marcas[marca]['idMarca']+"'><input type='checkbox' id='"+marcas[marca]['idMarca']+"M' name='marcas[]' value='"+id+"/"+marcas[marca]['idMarca']+"'><label for='"+marcas[marca]['idMarca']+"M'> "+name+"/"+marcas[marca]['Nombre']+"</label></li>");
			    }

			}
			else{

				for ( marca in marcas){
			         	
			         	
			         $('#marcas').find('#'+marcas[marca]['idMarca']).remove();
			    }

			}
			 


	}
	

</script>

	

@stop