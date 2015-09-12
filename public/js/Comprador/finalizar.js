
$(document).on('ready',finalizar);


function finalizar(){

	$('.calificar span').on('click',setNote);
}

function setNote(){

	var note = $(this).data('star');
	$('.calificar').html(' ');
	var estrellas = '';

	var calificacion = 0;

	for ( i=1;i<=note;i++){

		estrellas+='<span class="glyphicon glyphicon-star inline vmedio goodNote" ></span>';

		calificacion++;
	}

	$('.calificar').html(estrellas);

	$("input[name='Calificacion']").val(calificacion);
	console.log(calificacion);

}