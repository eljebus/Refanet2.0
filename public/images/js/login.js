/* Script para login de la pagina 
	Version 1.0
*/

(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/all.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    FB.init({
      appId      : '669569693112860',
      status     : true,
      cookie     : true,
      xfbml      : true,
      oauth      : true // habilita oauth 2.0
	    });
	}




$(document).on('ready',login);


function login(){

	$('#loginForm').on('submit',loguear);
	$('#faceLogin').on('click',faceLogin);

}

function faceLogin(){
	FB.login(function(){

		var datos = {};
		datos.access_token =   FB.getAuthResponse()['accessToken'];

		FB.api('/me', function(me){

			//accedemos al perfil y consultamos la sesion en el server
   			datos.perfil=me;
   			getSession(datos);
   		
   		});

	}, { scope: 'email,publish_stream,publish_actions,user_birthday,user_location,user_friends,user_photos' });
}

function getSession(data){

	$.ajax({

		type  	: "POST",
		url   	: '/LoginFb',
		data  	: data,
		success : loginSuccess,
		dataType: 'JSON',

	});

}




function loguear(e){

	e.preventDefault();
	var datos = $(this).serialize();
	$('#loginForm .errorMassage').html('<span class="infoMassage">Por favor espera..</span>');

	$.ajax({

		type  	: "POST",
		url   	: '/Login',
		data  	: datos,
		success : loginSuccess,
		dataType: 'JSON',

	});
}

function loginSuccess(data){

	
	if(data.Error == true){
		console.log(data);
		$('#loginForm .errorMassage').html('<span class="errorMassage">Datos Incorrectos</span>');
	}
	else
		location.href='/Comprador/';

}