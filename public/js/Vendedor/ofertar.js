// Archivo para nueva oferta
//Version 1.0

$(document).on('ready',iniciar);

var imagenes;

function iniciar(){

	imagenes = new uploadNew();
	$('#add-imagen').on('change',imagenes.uploadImage);

	$('#offerForm').on('submit',saveOffer);
}

/* Script para las ofertas 
version 1.0
*/

$(document).on('ready',ofertar);

var comentario = '';

var element;

function ofertar(){

	$('.fullSize').on('click',fullSize);

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



function saveOffer(e){
		
	e.preventDefault();

	//$('#button').attr('disabled','disabled');
	$('#button').html("Por favor espera");

	var form =  imagenes.setImages();


	form.append('Precio',$('input[name=Precio]').val());
	form.append('TiempoE',$('input[name=time]').val());
	form.append('Estado',$('select[name=Estado]').val());
	form.append('Categoria',$('input[name=Categoria]').val());
	form.append('Publicacion',$('input[name=idPieza]').val());
	form.append('Detalles',$('textarea[name=detalles]').val());



	$.ajax({

       url 			: '/Vendedor/Ofertar',
       type 		: 'POST',
       data 		: form,
       headers 		: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
       processData 	: false, 
       contentType 	: false, 
       success 		: function(res){
       	
          if(res.ok){

            window.location.href = "/Vendedor/Ofertas";
          }
       } 


    });



}


	
