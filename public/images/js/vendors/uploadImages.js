
function uploadImages()
{
	this.elemento='itemContainer';
	
    this.uploadImage=function (event)
	{     
	      var i = 0, len = this.files.length, img, reader, file;
	      $('#itemContainer .item').remove();
	      for( ; i < len; i++){
	      	if(i<=2){
	      		file = this.files[i];

	            if(!!file.type.match(/image.*/)){
	              if(window.FileReader){
	                  reader = new FileReader();
	                  reader.onloadend = function(e){

	                      mostrarImagenSubida(e.target.result);

	                  };
	                  reader.readAsDataURL(file);
	                  listaImagenes(file);

	              }
	            }
	      	}
	          
	      }
	};
	var element=this.elemento;
	var imagesList= new Array();

	function mostrarImagenSubida(source){
		
        var  	list 	= document.getElementById(element),
         		li  	= document.createElement('li'),
            	img  	= document.createElement('img'),
            	label 	= document.createElement('label');

        img.src = source;
        // label.setAttribute('class','icon-cross color-rojo');
        li.setAttribute('class','item');
        li.appendChild(img);

        //li.appendChild(label);
        list.appendChild(li);
    }

    function listaImagenes(file){
	  
	  imagesList.push(file);
	}



}