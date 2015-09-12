// Archivo para alta de nueva pieza
//Version 1.0

$(document).on('ready',iniciar);

var imagenes;

function iniciar(){

	imagenes = new uploadImages();
	$('#add-imagen').on('change',imagenes.uploadImage);
}