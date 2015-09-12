/* Script para las ofertas 
version 1.0
*/

$(document).on('ready',ofertar);

var comentario = '';

var element;

function ofertar(){

	$('.fullSize').on('click',fullSize);
	$('.comment').on('click',makeComment);
	$(document).on('keyup blur','.commentContent',setHeightArea);
	//$('#test').TextAreaExpander();

	//Evento para desplegar comentarios
	$('.coment').on('click',showHideComments);
	//Evento para las fotos de la oferta
	$('.photos').on('click',carrusel);

	//Evento para ver la reputacion del usuario
	$('.profile').on('click',profile);

}


function profile(){

	var datos = {
		perfil :$(this).data('idprofile')
	}; 

	$.ajax({

		type  	: "POST",
		url   	: '/Comprador/getProfile',
		data  	: datos,
		success : getProfile,
		dataType: 'JSON',

	});

	$('#perfil').modal('show');
	//$('#perfil .modal-body').html('Por favor Espere...');
}

function getProfile(data){

	//$('#perfil .modal-body').html('Exito');
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

	var comment = $(elemento).parent().find('textarea').val();
	var idOffer = $(elemento).data('offer');

	comentario = comment;
	$(elemento).parent().find('textarea').val('');
	$(elemento).parent().find('textarea').attr('disabled','disabled');
	
	element = $(elemento).attr('id');
	element = '#'+element;


	var datos = {

		'comentario' : comment,
		'idOferta'	 : idOffer
	}

	$.ajax({

		type  	: "POST",
		url   	: '/Comprador/comentar',
		data  	: datos,
		success : commentSuccess,
		dataType: 'JSON',

	});

}

function commentSuccess(data){

	if( data.Error == true )
		error.notificar(mensaje);
	else{

		var newComment = '<li class="list-group-item comments"> <span class="avatar inline"> <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/t1.0-1/c0.0.200.200/p200x200/10418274_10202577962864419_8758522733846340467_n.jpg" alt="" class="inline vmedio"> </span> <p class="inline textComment"> <span class="verde">Jesus cervantes:</span>'+comentario+'</p> </li>';

		$(element).parent()
				  .parent()
				  .parent()
				  .find('.groupComments').prepend(newComment);

		var comentNum = $(element).parent()
								  .parent()
								  .find('.comentNum');

		var comentarios = $(comentNum).html();
		comentarios	= parseInt(comentarios) + 1;

		$(comentNum).html(comentarios);



		console.log(comentarios);

		$(element).css('height','40px');

		$(element).removeAttr("disabled");

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
		
	

	

	/*var salts=this.value.split("\n").length-1;
	console.log(salts);             
	if(salts>=1){
		$(this).attr('rows',salts+1);
	}             
	if(salts<1){
		$(this).attr('rows',1);
	} */
}
