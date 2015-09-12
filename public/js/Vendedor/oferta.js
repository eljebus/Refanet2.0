$(document).on('ready',comentar);


function comentar(){

	$('.comment').on('click',makeComment);
	$(document).on('keyup blur','.commentContent',setHeightArea);
	//$('#test').TextAreaExpander();

	//Evento para desplegar comentarios
	$('.coment').on('click',showHideComments);

	$('.photos').on('click',carrusel);

	$('.fullSize').on('click',fullSize);
}

function hideComments(element){
	//Ocultamos los comentarios de la oferta
	$(element).parent()
		   .parent()
		   .parent()
		   .find('.groupComments')
		   .css({
				height : '0'		   	
		   });

    //Ocultamos el campo para el nuevo comentario y cambiamos sus propiedades
	$(element).parent()
	       .parent()
	       .find('.newComent')
	       .css({
	   			height 		:'0',
	   			marginTop 	:'0'
	   		});
}

function showComments(element){

	
	//Mostramos los comentarios de la oferta
	$(element).parent()
		   .parent()
		   .parent()
		   .find('.groupComments')
		   .css({
				height : 'auto'		   	
		   });

    //Mostramos el campo para el nuevo comentario y cambiamos sus propiedades
	$(element).parent()
	       .parent()
	       .find('.newComent')
	       .css({
	   			height 		:'auto',
	   			marginTop 	:'1em'
	   		});

}

function carrusel(){


	var arrayPhotos = $(this).data('photos');
	arrayPhotos 	= arrayPhotos.split("[photo]");


	if ( arrayPhotos.length == 1)
		return false;

	//Obtener elemento del carrusel y limpiarlo para poner nuevas imagenes
	element = $('#carrusel').find('.carousel-inner');
	element.html('');

	contador = 0; 
	//Recorremos el array y ponemos cada una de las fotos
	arrayPhotos.forEach(function(entry){

		//Detenemos el script si no se encuenta una url
		if(entry == '')
			return false;
		//Se asigna el elemento activo 
		var active = '';
		if(contador == 0)
			active ='active';

		var photo = '<div class="'+active+' item"><img  src="'+entry+'" /></div>';
		element.append(photo);
		contador++;

	});

	$('#carrusel').modal('show');
	//Carrusel de imagenes
	$('.myCarousel').carousel();
}



function fullSize(){

	var source = $(this).parent().find('img').attr('src');

	var title  = $(this).data('title');

	$('#imageLabel').html( title);
	$('#imageFull').attr('src',source);

}

function makeComment(elemento){

	var comment = $(elemento).val();
	var idOffer = $(elemento).data('id');
		idOferta= idOffer;	
		avatar  = $(elemento).parent().find('.photoAvatar').attr('src');
		userName= $(elemento).data('user');


	comentario = comment;
	$(elemento).parent().find('textarea').val('');
	$(elemento).parent().find('textarea').attr('disabled','disabled');
	

	var datos = {

		'Comentario' : comment,
		'Oferta'	 : idOffer
	}

	$.ajax({

		type  	: "POST",
		url   	: '/Vendedor/comentar',
		data  	: datos,
		success : commentSuccess,
		dataType: 'JSON',
       	headers 		: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },

	});

}

function commentSuccess(data){

	if( data.Error == true )
		error.notificar(mensaje);
	else{

		var newComment = '<li class="list-group-item comments"> <span class="avatar inline"> <img src="'+avatar+'"  class="inline vmedio"> </span> <p class="inline textComment"> <span class="verde">'+userName+': </span>'+comentario+'</p> </li>';

		$('#groupComments-'+idOferta).prepend(newComment);

		var element 	= "#area"+idOferta;

		var comentNum 	= $(element).parent()
								  .parent()
								  .find('.comentNum');

		var comentarios = $(comentNum).html();
		comentarios		= parseInt(comentarios) + 1;

		$(comentNum).html(comentarios);


		$(element).css('height','40px');

		$(element).removeAttr("disabled");

	}
}


function showHideComments(){

	var status 	= $(this).data('status');
	var idOffer = '#'+$(this).attr('id');

	if( status ==  'show'){
		hideComments(idOffer);
		$(this).data('status','hide');
	}
		
	else{
		showComments(idOffer);
		$(this).data('status','show');
	}
		
}




function setHeightArea(e){

	if(e.which == 13){
		return makeComment(this);
	}
	else{
		var alto = this.scrollHeight;

		if(alto > 40){
			this.style.height = 'auto';
	  		this.style.height = this.scrollHeight+'px';
		}
	}
		
}