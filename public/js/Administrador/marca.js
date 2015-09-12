
$(document).on('ready',iniciar);

var imagenes;

function iniciar(){

  imagenes = new uploadImages();

  $('#add-imagen').on('change',imagenes.uploadImage);
  
}


/*$(document).on('ready',iniciar);

var imagenes;

function iniciar(){


	if(window.FormData){

        imagenes = new uploadNew();
    }


    else{

    	imagenes = new uploadImages();
    }
	
	$('#add-imagen').on('change',imagenes.uploadImage);


	$('#new').on('submit',save);
}


function save(e){

	e.preventDefault();
	
	var form =  imagenes.setImages();

	$('input[name="files[]"]').remove();

	$.ajax({

       url : '/Administrador/newM',
       type : 'POST',
       data : form,
       processData : false, 
       contentType : false, 
       success : function(res){
       	
          console.log(res);
       } 


    });



}*/