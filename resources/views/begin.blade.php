@extends('layout')


@section('styles')

		{!! HTML::style('/css/inicio.css') !!}

@stop


@section('pre-content')

	<div id="imgContainer">

		<section id="imgContent">

			<img src="images/vato.png" class ='inline' alt="">

			<div id='infoContainer' class='inline'>

				<section id="info" class='inline'>

					<article>
						<p class=' titleRefa title'>
							REFANET
						</p>
						<p>
								La forma más rápida de encontrar o vender tus refacciones

						</p>


					</article>
				
				</section>

				<div id="botones" class='inline'>

					<a href='/Registro/Comprador/inicio'  class="btn btn-block btn-lg btn-primary">
						Busca Tu Refacción
					</a>


					<a href='/Registro/Vendedor/inicio' class="btn btn-block btn-lg btn-primary" id='buyer'>
						Vende Tus Refacciones
					</a>

				

				</div>
					
			</div>

			

		</section>

	</div>
@stop


@section('content')
	<section id='servicios' class='contentCenter'>
			<aside class="inline servicios">

				<span class='glyphicon glyphicon-search bigIcon inline orange'></span> 

				<article class='inline'>
					<p class='title inline'>Encuentra lo que buscas</p>
					<p>

						Publica tu refacción para que recibas ofertas de vendedores 

					</p>
				</article>
				
			</aside>

			<aside class="inline servicios ultimo">

				<span class='glyphicon glyphicon-usd bigIcon inline orange bg-rojo'></span> 

				<article class='inline'>
					<p class='title inline'>Vende Tus Refacciones</p>
					<p>
 						Registrate y encuentra compradores para tus piezas
					</p>
				</article>
				
			</aside>

			<aside class="inline servicios">

				<span class='glyphicon glyphicon-thumbs-up bigIcon inline orange bg-darkBlue'></span> 

				<article class='inline'>
					<p class='title inline'>El entorno más fácil</p>
					<p>

						La herramienta más sencilla que ter permitira vender o comprar
					</p>
				</article>
				
			</aside>
			
	</section>

	<section id='guiaContainer' class='inline'>


		<div id="guia" class='contentCenter'>
	
			
			<aside class='inline'>
				
				<p class='titleRefa'>REFANET</p>
				<p>
					Refanet la aplicacion para encontrar tus refacciones, de cualquier vehiculo y en cualquier parte del pais.

				</p>
				<p>
					Miles de Proveedores, Miles de Compradores, busca, vende, compra la refacción de tu vehículo.
				</p>	
				<p>
					No sufras más registrate en la mejor plataforma de refacciones
				</p>			
			</aside>

			<aside id="videoTutorial" class='inline'>

				<iframe width="100%" height="300" src="http://www.youtube-nocookie.com/embed/AIYIElNTJxU" frameborder="0" allowfullscreen></iframe>

			</aside>
		</div>
			
	</section>
@stop