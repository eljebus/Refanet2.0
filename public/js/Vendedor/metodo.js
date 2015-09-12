$(document).on('ready',metodo);

function metodo(){

	$('input:radio[name="metodo"]').change(
    function(){
       	

       	var value = $(this).val();

       	if(value === 'card'){


       		$('#payForm').show();
       		$('#payFormOxxo').hide();

       	}
       	else{

       		$('#payForm').hide();
       		$('#payFormOxxo').show();
       	}
     


    });
}