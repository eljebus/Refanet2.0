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



	if(metodo === 'contact'){

		profile();


	}
	else{

		$('#'+metodo).fadeIn('fast');
		$('#cardForm').on('submit',payCard);


	}

	

	//aplicamos el estilo a las guias
	style();
}

function style(){

	$('.begin').attr('class','itemInactive');
	$('.finish').attr('class','itemActive');
}



function profile(){

	$.ajax({

		type  	: "POST",
		url   	: '/Comprador/getProfile',
		success : getProfile,
		dataType: 'JSON',
		headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },

	});
}


function payCard(e){


	e.preventDefault();

	enableButton(false);
	
	var json 		=  $(this).serializeObject();

	var conekta 	= new Coneckta(key);

	if(!conekta.params(json)){

		$('#cardError').html('Verifica tus datos');

		
		enableButton(true);

		return false;
	}
		
	$('#cardError').html('');

	conekta.success(tokenSuccess);

	conekta.tokenizr();

}

function enableButton(bandera){

	if(bandera){

		$('#send').removeAttr('disabled');
		$('#send').html('Realizar Pago');
	}
	else{

		$('#send').attr('disabled','disabled');
		$('#send').html('Por favor espera...');
	}

}

//metodo par convertir a json un formulario
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


function getProfile(data){

	if(data.Error == false){

		var user  = data.Usuario;

		var stars = '';

		//Mostrar seccion de datos
		$('#contact').fadeIn('fast');

		//Rellenar datos
		$('#userName').html(user.Nombre);
		$('#Avatar').attr('src',user.Avatar);
		$('#Address').html(user.Domicilio+' CP: '+user.CP);
		$('#Mail').html(user.Mail);
		$('#tel').html(user.Tel);


		for(i=1;i<=data.Calificacion;i++){

			stars+='<span class="glyphicon glyphicon-star inline goodNote"></span>';
			  		
		}

		for(i=1;i<=(5 - data.Calificacion);i++){

			stars+='<span class="glyphicon glyphicon-star inline"></span>';
			  		
		}


		$('#note').html(stars);

	}
		

}

function tokenSuccess(token){

	var form =  new FormData();

	form.append('Token',token.id);
	form.append('Oferta',$('input[name=oferta]').val());
	form.append('Comentario',$('textarea[name=Comentarios]').val());


	$.ajax({

	       url 			: '/Vendedor/setPay',
	       type 		: 'POST',
	       data 		: form,
	       headers 		: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
	       processData 	: false, 
	       contentType 	: false, 
	       success 		: function(res){


	       	//console.log(res);
	       	
	          if(res.ok){

	            window.location.href = "/Comprador/Compras";
	          }
	       } 


    });



}