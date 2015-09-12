<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Refanet</title>

	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/css/index.css">



</head>
<body>


	<div id="container">
		<div id="logo">
			<img src="/images/refanet.png" alt="" class='inline vmedio'>
			<h1 class='inline vmedio'>REFANET</h1>

			<h2> El mejor lugar para comprar o vender tus refacciones</h2>

			<h3>Selecciona una categoría</h3>

		</div>
		<ul id='categorys'>

			@foreach( $datos['categorias'] as $categoria)
			<li>
				<a href="/{{$categoria->Nombre}}" title="{{$categoria->Nombre}}">
					<span class="glyphicon glyphicon-plus"></span>
					&nbsp;&nbsp;
					<span class="name">{{$categoria->Nombre}}</span>
				</a>
			</li>
			@endforeach

			


		</ul>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
</body>
</html>