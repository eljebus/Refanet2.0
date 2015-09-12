
function Coneckta (publica){


	this.privada =	'Unknown';
	this.publica = 	publica;


	var errorResponseHandler, 
		successResponseHandler, 
		tokenParams;

	Conekta.setPublishableKey(this.publica);


	this.params = function(data){

		if(!validate(data))
			return false;

		tokenParams = {
		  "card": {
		    "number"	: data.Numero,
		    "name"		: data.Name,
		    "exp_year"	: data.Year,
		    "exp_month"	: data.Month,
		    "cvc"		: data.Cvc
		  }
		};

		return true;

	}


	function validate(data){

		if(!Conekta.card.validateNumber(data.Numero)) 
			return false;
		else if(!Conekta.card.validateExpirationDate(data.Month, data.Year))
			return false;
		else if(!Conekta.card.validateCVC(data.Cvc))
			return false
		else
			return true;
	}

	this.success = function(callback){

		successResponseHandler = callback;


	}


	/* Después de recibir un error */

	errorResponseHandler = function(error) {
	  return console.log(error);
	};


	this.tokenizr = function(){

		Conekta.token.create(	tokenParams, 
								successResponseHandler, 
								errorResponseHandler);
	}


}