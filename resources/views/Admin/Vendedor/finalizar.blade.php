@extends('Admin/Vendedor/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Vendedor/finalizar.css') !!}

@stop


@section('pre-content')
	
				


	
@stop


@section('content')
	
	
	<h2 class="mediumTitles orange  fontNormal inline top-none">

		{{$datos['publicacion']->refaccion()->first()->Nombre}}


	</h2>
	<span class="floatRight">Referencia {{$datos['oferta']->idOferta}}</span>

	<div id="container">
		<div class="floatLeft">
			<img src="{{$datos['publicacion']->refaccion()
											->first()
											->galeria()
											->where('Status','=','1')
											->first()
											->Archivo}}">
		</div>
		<div class="floatRight fontNormal">
			<span class="monto">
				<span class="glyphicon glyphicon-certificate inline vmedio"></span>
				<span class='inline vmedio'> 
					Monto: $ {{number_format( $datos['oferta']->Precio, 2, '.', ', ' )}}
				</span>
			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-user inline vmedio"></span>
				<span class='inline vmedio'> 
					Comprador: {{$datos['publicacion']->usuario()->first()->Nombre}}
				</span>
			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-credit-card inline vmedio"></span>
				<span class='inline vmedio'> 
					Pago: {{$datos['oferta']->compra()->first()->Forma}}
				</span>
			</span>

			<span class="calificar">
				Califica al Comprador <br>
				<span class="glyphicon glyphicon-star inline" data-star='1'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='2'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='3'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='4'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='5'></span>
			</span>

			<br>
			{!! Form::open(array('id'		=>'comment',
								 'method'	=>'POST',
								 'url'		=>'/Vendedor/finishBuy')) !!}

				<span class="glyphicon glyphicon-comment inline vmedio"></span>


				<input type="hidden" name='Calificacion'>

				<input 	type="hidden" 
						name='compra' 
						value="{{$datos['oferta']->compra()->first()->idCompra}}">

				<textarea 	class="form-control inline vmedio commentContent"  
							placeholder='Escribe aquí tu comentario' 
							required  
							id='area2' 
							name = 'Comentario'
							rows='1'></textarea>

				<button type="submit" class="btn btn-primary btn-lg btn-block floatRight">

	            	Finalizar Venta
	            </button>


			{!! Form::close() !!}

		</div>
	</div>
	
	
	
@stop
@section('scripts')
	
	{!! HTML::script('/js/Vendedor/finalizar.js')!!}


@stop