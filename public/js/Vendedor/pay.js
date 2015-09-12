var bandera = false;


	function payOxxo(e){


		

		if(!bandera){

			$('.cardError').html('Necesitas seleccionar un plan');

			
			enableButton(true);

			return false;

		}

		else
			$('#payFormOxxo').submit();



	}

		function payCard(e){


			e.preventDefault();

			enableButton(false);
			
			var json 		=  $(this).serializeObject();

			var conekta 	= new Coneckta('key_FEAYsGAvheypZbin');

			if(!conekta.params(json)){


				$('.cardError').html('Verifica tus datos');

				
				enableButton(true);

				return false;
			}

			else if(!bandera){

				$('.cardError').html('Necesitas seleccionar un plan');

				
				enableButton(true);

				return false;

			}

				
			$('.cardError').html('');

			conekta.success(tokenSuccess);

			conekta.tokenizr();

		}


		function enableButton(bandera){

			if(bandera){

				$('.send').removeAttr('disabled');
				$('.send').html('Realizar Pago');
			}
			else{

				$('.send').attr('disabled','disabled');
				$('.send').html('Por favor espera...');
			}

		}


		function tokenSuccess(token){



			
			var form =  new FormData();

			form.append('Token',token.id);
			form.append('Plan',$('input[name=Plan]').val());
			form.append('Type',$('#payForm').find('input[name=Type]').val());

			

			$.ajax({

			       url 			: '/Vendedor/setPay',
			       type 		: 'POST',
			       data 		: form,
			       headers 		: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
			       processData 	: false, 
			       contentType 	: false, 
			       success 		: function(res){


			       	//console.log(res);
			       	
			          if(res.ok){

			            window.location.href = "/Vendedor/";
			          }
			       } 


		    });



		}

		//metodo par convertir a json un formulario
		$.fn.serializeObject = function(){
		    var o = {};
		    var a = this.serializeArray();
		    $.each(a, function() {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
		            o[this.name].push(this.value || '');
		        } else {
		            o[this.name] = this.value || '';
		        }
		    });
		    return o;
		};




		$(document).on('ready',plan);



		function plan(){


			$('.pallete-item').on('click',selectMethod);

			$('#payForm').on('submit',payCard);

			$('#oxxoForm').on('click',payOxxo);


		}

		function selectMethod(){

			bandera = true;


			$('.pallete-item').attr('class','pallete-item fontNormal');

			$('.pallete-item span').css('display','none');

			$(this).attr('class','pallete-item fontNormal active');
			$(this).find('span').css('display','block');

			var plan = $(this).data('plan');
			$('input[name=Plan]').val(plan);


		}