<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta lang='es'>
		<title>Orden de pago</title>

		<style>
				
				#header{
					width:100%;
					background: #006b75;

					color:white;

				}

				#headerContent,#contenido{
					 width:80%;
					 margin:auto;
					 padding:  1em
				}
				body{
					padding: 0;
					margin: 0;
				}
				.inline{

					display:inline-block;
					vertical-align: middle;
				}
				h1{
					width: 50%;
					text-align: center;
				}
			
		</style>
	</head>


	<body>

		<div id='header'>
			
			<div id='headerContent'>
				
				<img src="/images/refapdf.png" class='inline'>

			</div>
			
			
		</div>

		<div id="contenido">
			
			<h2>Orden de pago</h2>

			<p>Referencia: {{$Referencia}}</p>
			<p>Concepto:  {{$Descripcion}}</p>
			<p>Monto: <strong>$ {{number_format( $Precio/100, 2, '.', ', ' )}}</strong></p>


			<br>

		<p>
			
			<center>
				
				<img src="/images/oxxo.png" width='150'>
				<br>
				<br>
				<img src="{{$Codigo}}" alt="">
			</center>
		</p>

			

		</div>


		
	</body>
</html>