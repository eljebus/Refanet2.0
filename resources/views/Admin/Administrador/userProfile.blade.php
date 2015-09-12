@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/profile.css') !!}
		{!! HTML::style('//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css') !!}
		<style>

			.bootstrap-tagsinput {
			    width: 100%;
			}
			.label {
			    line-height: 2 !important;
			}
		</style>

@stop


@section('pre-content')
	
				

	
@stop


@section('content')

	<?php $user = $datos['usuario']; ?>
	
	<h3 class='naranja'> {{$user->Nombre}}</h3>


	<section id='description'>



		<div id='picture' class='inline'>
			<div>
				<img 	src="{{$user->Avatar}}" 
						alt="{{$user->Nombre}}">
			</div>

			<center>
				<strong>
				
					<i>
						
				
					@if(array_key_exists('cliente',$datos))

						Vendedor

						@if($datos['cliente']->contrato()->first()->Status === 2)

							Inactivo

						@else

							Activo

						@endif
					@endif

					</i>
				</strong>
				<br>
				<br>
				<button type		=	"button" 
						class		=	"btn btn-danger"
						data-toggle = 	"modal" 
						data-target = 	"#danger">
					Bloquear Usuario
				</button>

			</center>
			
			

		</div>

		<div id='dataProfile' class='inline'>

			<ul>

				<li>
					Estado:
					<span class="textBold verde"> Activo </span>
				</li>		
	
				@if(array_key_exists('cliente',$datos))

					<li>
						Perfiles:
						<span class="textBold">Vendedor/Comprador</span>
					</li>



					@if($datos['cliente']->contrato()->first()->Status === 1)
						
						<?php $contrato = $datos['cliente']->contrato()->first(); ?>

						<li>
							Plan:
							<span class="textBold">
								{{$contrato->Tipo}} &nbsp;&nbsp;&nbsp;{{$contrato->Inicio}} / {{$contrato->Fin}}
							</span>
						</li>

					@endif
				@else
					<li>
						Perfil:
						<span class="textBold">Comprador</span>
					</li>


				@endif

				
				<li>
					Cliente desde:
					<span class="textBold">

						{{$user->updated_at}}
					</span>
				</li>


				

				<li>
					Dirección: 
					<span class='textBold'>
						{{$user->Domicilio}} /  {{$user->Estado}}
					</span>
				</li>


				<li>
					Mail:
					<span class="textBold">
						{{$user->Mail}}
					</span>
				</li>

				<li>
					Telefono:
					<span class="textBold">
						{{$user->Tel}}
					</span>
				</li>

				<li>
					Reputación:
					@if(!is_null($user->reputacion()->first()))
					
						@for( $i = 1; $i<= $user->reputacion()->first()->Calificacion; $i++ )

							<span class="glyphicon glyphicon-star inline goodNote"></span>

						@endfor
					@else
						<strong> Sin calificar</strong>
					@endif
					
				
				</li>

				<li>
					Transacciones:
					<span class="textBold">

						{{$user->publicaciones()->count()}} publicaciones
						
						@if(!is_null($user->vendedor()->first())) 

							/ {{$user->vendedor()->first()->ofertas()->where('Status','=','4')->count()}} Ventas

						@endif

					</span>
				</li>


			</ul>


			
		</div>
		<br>
		<br>

		@if(array_key_exists('cliente',$datos))

			{!! Form::open(array('url' =>'/Administrador/sugerencias',
								'method'=>'POST',)) !!}

				
				<div class="form-group">
			        <label class="control-label">Sugerencias al Vendedor</label>
			        <div class="">
			            <input 	type="text" 
			            		name="keywords" 
			            		class="form-control"
			                   	value="@foreach($datos['usuario']->vendedor()
			    										  ->first()
			    										  ->keywords()
			    										  ->where('Status','=',1)
			    										  ->get() as $key) 
			    						{{$key->Meta}},
			    						@endforeach" 
			                   	data-role="tagsinput" />
			        </div>
			    </div>



			    <input type="hidden" name='user' value="{{$datos['usuario']->vendedor()
			    															->first()
			    															->idVendedor}}">
				
				<input type="hidden" name='idUser' value="{{$datos['usuario']->id}}" >

			    <button type='submit' class="btn btn-success btn-block" style='width:200px'>
			    	Guardar sugerencias 
			    </button>

			{!! Form::close() !!}



		@endif

		<br>
		<br>
		<br>
		<br>
		
	</section>



	<div class="modal fade bs-example-modal-sm" id='danger'>
		  <div class="modal-dialog modal-sm">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type			=	"button" 
		        		class			=	"close" 
		        		data-dismiss	=	"modal" 
		        		aria-label		=	"Close"
		        >

	        	<span aria-hidden="true">&times;</span></button>

	        	<h4 class="modal-title">Cuidado</h4>

		      </div>
		      <div class="modal-body">
		        <p>
		        	Estas apunto de bloquear
		        	<strong>
		        		<i>{{$user->Nombre}}</i>
		        	</strong>, 
		        	estas seguro de querer hacerlo?

		        </p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-default ">


		        	<a href="/Administrador/deleteUser/{{$user->id}}">
		        		Si, estoy seguro
		        	</a>
		        	
		        </button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
	

	
	
@stop

@section('scripts')

	{!! HTML::script('//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js')!!}



<script>

	function stopRKey(evt) { 
		var evt = (evt) ? evt : ((event) ? event : null); 
		var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 

	document.onkeypress = stopRKey; 

</script>
@stop