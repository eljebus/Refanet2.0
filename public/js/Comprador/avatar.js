

$(document).on('ready',iniciar);


function iniciar(){


	var avatar  = new uploadAvatar();

	$('#avatarInput').on('change',avatar.uploadImage);

}


function uploadAvatar()
{

	var formdata 	= 	new FormData();

	var element=this.elemento;

    this.uploadImage=function (event)
	{     

	     var i = 0, len = this.files.length, img, reader, file;

	     // $('#itemContainer .item').remove();
	      
	      		
	     	file = this.files[i];
        if(!!file.type.match(/image.*/)){
          if(window.FileReader){
              reader = new FileReader();
              reader.onloadend = function(e){
                 
                mostrarImagenSubida(e.target.result,file.name);

              };
              reader.readAsDataURL(file);


          }
        }
	    	          
	      

	


	};
	

	function mostrarImagenSubida(source){
	

      	$('#avatar').attr('src',source);


    }

    



}



