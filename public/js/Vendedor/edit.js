// Archivo para alta de nueva pieza
//Version 1.0

$(document).on('ready',iniciar);

var imagenes;

var deleteImg =  [];

function iniciar(){


	if(window.FormData){

        imagenes = new uploadNew(contador);
    }


    else{

    	imagenes = new uploadImages();
    }
	
	$('#add-imagen').on('change',imagenes.uploadImage);


	$('#offerForm').on('submit',save);


  $('.editDelete').on('click',saveDelete);


}


function saveDelete(){

    var element = $(this).data('id');
    deleteImg.push(element);

}


function save(e){

	e.preventDefault();

  
  $('#button').attr('disabled','disabled');
  $('#button').html("Por favor espera");
	
	var form =  imagenes.setImages();
	form.append('oferta',$('input[name=oferta]').val());
	form.append('Precio',$('input[name=Precio]').val());
	form.append('Estado',$('select[name=Estado]').val());
	form.append('TiempoE',$('input[name=time]').val());
	form.append('description',$('textarea[name=detalles]').val());
  form.append('imagenes',imagenes.setImages());
  form.append('deletedImg',deleteImg);

	$('input[name="files[]"]').remove();

	$.ajax({

       url : '/Vendedor/ModifyOffer',
       type : 'POST',
       data : form,
       headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
       processData : false, 
       contentType : false, 
       success : function(res){
       	
          if(res.ok){

            window.location.href = "/Vendedor/Oferta/"+$('input[name=oferta]').val();
          }
       } 


    });



}