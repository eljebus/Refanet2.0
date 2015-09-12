
	$(document).on('keyup blur','.commentContent',setHeightArea);

	function setHeightArea(e){

		if(e.which == 13){
			return makeComment(this);
		}

		else{
			var alto = this.scrollHeight;

			if(alto > 40){
				this.style.height = 'auto';
		  		this.style.height = this.scrollHeight+'px';
			}
		}
	}

	function makeComment(elemento){

		var form = new FormData();
		form.append('Ticket',$(elemento).data('idticket'));
		form.append('Contenido',$(elemento).val());
		$(elemento).attr('disabled','disabled');


		$.ajax({

	       url : '/Vendedor/preguntar',
	       type : 'POST',
	       data : form,
	       headers : { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
	       processData : false, 
	       contentType : false, 
	       success : function(res){
	      
	          if(res.ok){

	            addQuery(elemento);

	          }
	       } 


	    });
		


	}




	function addQuery(elemento){


		var comment =  $(elemento).val();

		$(elemento).val('');

		$(elemento).removeAttr('disabled');
		
		var content = '<li class="list-group-item"> <span class="verde textBold ">'+usuario+': </span> '+ comment +'</li>';

		var add =  $(elemento).parent().parent();

		$(add).after(content);

	}