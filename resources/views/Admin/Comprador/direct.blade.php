@extends('Admin/Comprador/origin')


@section('styles')

		{!! HTML::style('/css/Admin/Comprador/buy.css') !!}

@stop


@section('pre-content')
	
@stop


@section('content')
		<div class='bg-gray'>

			<ul class='list-none contentCenter' id='etapas'>

				<li class='itemInactive'>

					<span class="itemCircle  white inline vmedio ">1</span>
					<p class='inline vmedio bottom-none'>Seleccionar Método</p>

				</li>

				<li class='itemActive'>

					<span class="itemCircle white inline vmedio ">2</span>
					<p class='inline vmedio bottom-none'>Realizar Compra</p>

				</li>

			</ul>
			
		</div>
		<section id="registerForm" class='contentCenter'>

			<h3 class="bigTitles inline vmedio fontNormal top-none">Oferta número 37 </h3>
			<h4 class='inline vmedio fontNormal top-none mediumTitles'>
				Monto: 
				<span class="orange"> $ 1,500.00</span>
			</h4>

			<div class="alert alert-success fontNormal" role="alert">
		      <strong>Listo!</strong> Se ha notificado al vendedor para que se ponga en contacto contigo, te proporcionamos a continuación los datos del mismo
		    </div>


			<div class="dataProfile fontNormal">
				<p class="bigTitles orange"> Acabas de comprar Marcha Electrónica</p>
				<span class="avatar inline vmedio">
		  			<img src="/images/avatar.jpg" alt="">
		  		</span>
		  		
		  		<span class="inline name vmedio profile" data-idprofile='1'>
		  			 &nbsp;Jesus cervantes Gonzalez

		  		</span>

		  		<div id="note">
		  			<span class="inline vmedio">Reputación: &nbsp;&nbsp;</span> 
		  			<span class="glyphicon glyphicon-star inline vmedio goodNote"></span>
		  			<span class="glyphicon glyphicon-star inline vmedio goodNote"></span>
		  			<span class="glyphicon glyphicon-star inline vmedio goodNote"></span>
		  			<span class="glyphicon glyphicon-star inline vmedio goodNote"></span>
		  			<span class="glyphicon glyphicon-star inline vmedio"></span>
		  		</div>

		  		<span class="mail">
		  			<span class="glyphicon glyphicon-envelope"> </span>
		  			jesuscervantes82@hotmail.com
		  		</span>
		  		<br>
		  		<span>
		  			<span class="glyphicon glyphicon-send"></span>
		  			Jamay Jalisco Hidalgo 223 colonia centro
		  		</span>

		  		<div class="alert alert-info minAlert" role="alert">
			      <strong>Recuerda</strong> Cuando recibas tu pieza finaliza la compra y califica al vendedor
			    </div>

				<a href="#fakelink" class="btn btn-block btn-lg btn-info">Listo</a>


			</div>





		</section>
				

	



	
	
@stop