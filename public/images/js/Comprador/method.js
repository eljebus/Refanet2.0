//Script para seleccion de metodos de pago
//Version  1.0

$(document).on('ready',metodos);

function metodos(){


	$('.methodName').on('click',payMethod);
}


function payMethod(e){

	e.preventDefault();
	var metodo 	= $(this).data('method');

	//mostramos el metodo y colutamos los selectores
	
	$('#methods').fadeOut('slow',function(){
		$('#methods').remove();
		setMethod(metodo);
	});

}


function setMethod(metodo){

	$('#'+metodo).fadeIn('fast');

	//aplicamos el estilo a las guias
	$('.begin').attr('class','itemInactive');
	$('.finish').attr('class','itemActive')
}