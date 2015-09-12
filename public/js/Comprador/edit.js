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


	$('#articleForm').on('submit',save);


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
	form.append('name',$('input[name=name]').val());
	form.append('type',$('input[name=type]').val());
	form.append('marck',$('select[name=marck]').val());
	form.append('model',$('input[name=model]').val());
	form.append('description',$('textarea[name=description]').val());
  form.append('imagenes',imagenes.setImages());
  form.append('deletedImg',deleteImg);
  form.append('id',$('input[name=id]').val());


	$('input[name="files[]"]').remove();

	$.ajax({

       url : '/Comprador/SaveEdit',
       type : 'POST',
       data : form,
       headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
       processData : false, 
       contentType : false, 
       success : function(res){
       	
          if(res.ok){

            window.location.href = "/Comprador";
          }
       } 


    });



}