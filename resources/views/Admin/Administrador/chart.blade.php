@extends('Admin/Administrador/layout')


@section('styles')

		{!! HTML::style('/css/Admin/Administrador/index.css') !!}

@stop


@section('pre-content')


	
@stop


@section('content')

	<div class="container-fluid">
	    <canvas id="GraficoBarra" style="width:50%;"></canvas>
	</div>
	
	<php $data = array(); ?>

	@foreach($compras as $compra)
		

		<?php
	    	
	    	$data[$compra->Nombre] = array(intval ($compra->cantidad));
		?>
		
	@endforeach



	{!! app()->chartbar->render("GraficoBarra", $data) !!}

	
	

	
	
@stop