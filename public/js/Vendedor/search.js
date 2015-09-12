
	$(document).on('ready',search);

	function search(){

		$('#search').on('keyup blur',getSearch);

		$('#category').on('change',setCategory);
	}


	function setCategory(){

		var categoria = $(this).val();

		window.location="/Vendedor/Categoria/"+categoria;
	}



	function getSearch(e){

		if(e.which == 13){
			
			$('#searchForm').submit();

		}
	}
