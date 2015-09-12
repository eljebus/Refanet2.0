@extends('Admin/Comprador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/finalizar.css') !!}

@stop


@section('content')
	

	<h2 class="mediumTitles orange  fontNormal inline top-none">
		{{$datos['publicacion']->refaccion()->first()->Nombre}}
	</h2>
	

	<span class="floatRight">Referencia {{$datos['compra']->idCompra}}</span>
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
					Vendedor: {{$datos['oferta']->vendedor()
												->first()
												->usuario()
												->first()
												->Nombre}}
				</span>
			</span>

			<span class="vendedor">
				<span class="glyphicon glyphicon-credit-card inline vmedio"></span>
				<span class='inline vmedio'> 
					Pago: {{$datos['oferta']->compra()->first()->Forma}}
				</span>
			</span>

			<span class="calificar">
				Califica al Vendedor <br>
				<span class="glyphicon glyphicon-star inline" data-star='1'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='2'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='3'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='4'></span>
	  			<span class="glyphicon glyphicon-star inline" data-star='5'></span>
			</span>

			<br>
			{!! Form::open(array('id'		=>'comment',
								 'method'	=>'POST',
								 'url'		=>'/Comprador/finishBuy')) !!}

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
							rows='2'></textarea>

				<button type="submit" class="btn btn-primary btn-lg btn-block floatRight">

	            	Finalizar Venta
	            </button>


			{!! Form::close() !!}

		</div>
	</div>
	
	
	
@stop
@section('scripts')
	
	{!! HTML::script('/js/Comprador/finalizar.js')!!}


@stop