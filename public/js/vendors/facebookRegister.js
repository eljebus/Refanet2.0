(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
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



$(document).on('ready',loguear);


var face;
function loguear(){


	var permisos='email,publish_actions,user_birthday,user_location,user_friends,user_photos';

 	face=new FacebookLogin(permisos,loginSuccessRegister,'#fblogin');
 	face.iniciar();
}


function loginSuccessRegister(data){


	$('.removeFb').remove();

	$('.infoMassage').html('<img src="'+data.photo+'" alt="'+data.perfil.name+'" id="foto">');

	$('input[name=name]').val(data.perfil.name);
	$('input[name=mail]').val(data.perfil.email);

	$('input[name=domicilio]').val(data.perfil.location.name);

	$('input[name=foto]').val(data.photo);

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


		$('#fbLogin').attr('disabled','disabled');

		var dato={
			'datos':datos
		}

		callback(datos);
	
	}

	function loginSuccess(response){

		if(response.error == 'false'){

			callback(datos);
		}
			
		else{
			openError('No pudimos conectarnos, intenta con tu correo');
			$(objectEvent).html('No pudimos conectar con fb');
			$('#fbLogin').removeAttr('disabled');
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




/*array(14) { 
	["id"]=> string(17) "10203108961299048" 
	["birthday"]=> string(10) "12/22/1985" 
	["email"]=> string(28) "jesuscervantes82@hotmail.com" 
	["first_name"]=> string(5) "Jesus" 
	["gender"]=> string(4) "male" 
	["last_name"]=> string(8) "Gonzalez" 
	["link"]=> string(62) "https://www.facebook.com/app_scoped_user_id/10203108961299048/" 
	["location"]=> array(2) { 
								["id"]=> string(15) "108127335887092" 
								["name"]=> string(14) "Jamay, Jalisco" 
							} 
	["locale"]=> string(5) "es_LA" 
	["middle_name"]=> string(9) "Cervantes" 
	["name"]=> string(24) "Jesus Cervantes Gonzalez" 
	["timezone"]=> string(2) "-6" 
	["updated_time"]=> string(24) "2014-10-12T19:36:04+0000" 
	["verified"]=> string(4) "true"}*/