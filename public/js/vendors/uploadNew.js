
function uploadNew()
{
	var max 		= 	2;
	var contador	=	0;
	var imageCount  =   0;
	var formdata 	= 	new FormData();

	this.elemento	=	'itemContainer';

	var listImages 	= new Array();


	var element=this.elemento;
	var imagesList= 	[];


	//Se agrega el evento quitImage para quitar la imagen de la lista
	$(document).on('click','.delete',quitImage);

    this.uploadImage=function (event)
	{     

		  var restantes = max - contador;

	      // Valida si se llega al tope maximo de ser asi regresa falso
	      if(restantes < 0){

	      		return false;
	      }
	      	
	      var i = 0, len = this.files.length, img, reader, file;

	     // $('#itemContainer .item').remove();
	      for(i=0 ; i < len; i++){
	      	if(i<=restantes){
	      		file = this.files[i];

	      		//formdata.append('files[]',file);


	            if(!!file.type.match(/image.*/)){
	              if(window.FileReader){
	                  reader = new FileReader();
	                  reader.onloadend = function(e){
	                     
	                    mostrarImagenSubida(e.target.result,file.name);

	                  };
	                  reader.readAsDataURL(file);


	                  var indice = file.name;

	                  imagesList[indice ] = file;

	                  console.log(imagesList);

	                  contador++;

	              }
	            }
	      	}
	          
	      }


	      if( contador == max+1){
	      	$('input[name="files[]"]').prop('disabled', true);
	      }
	      	


	};
	

	function mostrarImagenSubida(source,name){
	

        var  	list 	= document.getElementById(element),
         		li  	= document.createElement('li'),
            	img  	= document.createElement('img'),
            	label 	= document.createElement('span');

        img.src = source;
        label.setAttribute('class','icon-cancel-circle rojo delete');
        
        li.setAttribute('class','item');
        li.setAttribute('data-file',name);
        li.appendChild(img);

        li.appendChild(label);
        list.appendChild(li);

        imageCount ++;
    }

    function quitImage(){

    	var index =  $(this).parent().data('file');

    	delete imagesList[index];


    	contador--;
    	imageCount --;

    	$(this).parent().remove();

    	//Habilitamos el input file
    	$('input[name="files[]"]').prop('disabled', false);


    	//devolvemos a null el valor del input file
    	$('input[name="files[]"]').val("");


    }

    this.setImages = function(){

    	for( file in imagesList ){
    		
    		formdata.append('files'+file,imagesList[file]);
    	}
    		

    	return formdata;
    }



}



