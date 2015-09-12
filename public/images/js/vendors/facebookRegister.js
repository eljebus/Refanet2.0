(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/all.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



window.fbAsyncInit = function() {
    FB.init({
      appId      : '580500838733109',
      status     : true,
      cookie     : true,
      xfbml      : true,
      oauth      : true // habilita oauth 2.0
	    });
	}



$(document).on('ready',loguear);


var face;
function loguear(){


	var permisos='email,publish_stream,publish_actions,user_birthday,user_location,user_friends,user_photos';

 	face=new FacebookLogin(permisos,loginSuccess,'#fblogin');
 	face.iniciar();


}


function loginSuccess(data){

	$('.removeFb').remove();
	$('input[name=name]').val(data.perfil.name);
	$('input[name=mail]').val(data.perfil.email);
}




function FacebookLogin(permisos,callback,objectEvent){

	

	var datos={};

	this.iniciar=function(){

		$(objectEvent).on('click', function(e){


				FB.login(function(){

					datos.access_token =   FB.getAuthResponse()['accessToken'];

						getData();

				}, { scope: permisos });

		});

		//return getData();
	};


	function setData(datos){



		var dato={
			'datos':datos
		}

		/*$.ajax({
		  type: "POST",
		  url: '/setSession',
		  data: dato,
		  success: loginSuccess,
		  dataType: 'JSON',
		});*/

		
		callback(datos);
	
	}

	function loginSuccess(response){


			
		if(response.error == 'false'){

			callback(datos);
		}
			
		else{
			openError('No pudimos conectarnos, intenta con tu correo');
			$(objectEvent).html('No pudimos conectar con fb');
			$('#login').dialog('close');

		}
			

	}

	function getData(){
		FB.api('/me', function(me){

			//Efecto sobre boton de fb

			$(objectEvent).html('<center><span class="fontNormal">Un momento por favor...</span>');

   			datos.perfil=me;
   		
   			FB.api('/me/picture', function(photo){
   				datos.photo=photo.data.url;
   				setData(datos);
   			});
   		});
	}




	this.fillFields=function(data,form){
				
		$(form).find(':input').each(function() {

			var fieldName=$(this).attr('name');
			var elemento=$(this);

			$.each(data, function(index,value) {
				if (fieldName==index){

					$(elemento).attr('value',value);
				}

			});
		});


	}

}




