
/* Script manejador de errores mediante dialogos de bootstrap*/


var error = new errorController();

function errorController(){

	this.elemento ='#errorModal';

	this.notificar = function (message){

		$(this.elemento).modal('show');
		$('#errorMessageModal').html(message);
	}

}