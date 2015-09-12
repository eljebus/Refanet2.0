
function uploadImages()
{
	var max = 8;
	this.elemento='itemContainer';

	var element=this.elemento;
	var imagesList= new Array();
	
    this.uploadImage=function (event)
	{     

	      var i = 0, len = this.files.length, img, reader, file;

	      var restantes = max - imagesList.length;

	      // Valida si se llega al tope maximo de ser asi regresa falso
	      if(restantes<0)
	      	return false;

	     // $('#itemContainer .item').remove();
	      for(i=0 ; i < len; i++){
	      	if(i<=restantes){
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
	      	}
	          
	      }


	};
	

	function mostrarImagenSubida(source,file){
		

        var  	list 	= document.getElementById(element),
         		li  	= document.createElement('li'),
            	img  	= document.createElement('img'),
            	label 	= document.createElement('label');

        img.src = source;

        li.setAttribute('class','item');
        li.setAttribute('data-file',file);
        li.appendChild(img);

        list.appendChild(li);
    }



}