// Archivo para alta de nueva pieza
//Version 1.0

$(document).on('ready',iniciar);

var imagenes;

function iniciar(){


	if(window.FormData){

        imagenes = new uploadNew();
    }


    else{

    	imagenes = new uploadImages();
    }
	
	$('#add-imagen').on('change',imagenes.uploadImage);


	$('#articleForm').on('submit',save);

  $('select[name=category]').change(marcks);


}

function marcks(){


    var categoria =  $(this).val();


    var marcas ='';

    $('#cRemove').remove();

    $.ajax({

       url : '/getMarcks/'+categoria,
       type : 'GET',
       processData : false, 
       contentType : false, 
       success : function(res){
        
         $.each( res, function( i, marca ){
            
            marcas+=' <option value="'+marca.idMarca+'">'+marca.Nombre+'</option>';


          });

         $('#marck').html(marcas);
       } 


    });

}


function save(e){

	e.preventDefault();
	
  $('#button').attr('disabled','disabled');
  $('#button').html("Por favor espera");

	var form =  imagenes.setImages();
	form.append('name',$('input[name=name]').val());
	form.append('type',$('input[name=type]').val());
	form.append('marck',$('select[name=marck]').val());
  form.append('category',$('select[name=category]').val());
	form.append('model',$('input[name=model]').val());
	form.append('description',$('textarea[name=description]').val());
  form.append('imagenes',imagenes.setImages());


	$('input[name="files[]"]').remove();

	$.ajax({

       url : '/Comprador/Save',
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