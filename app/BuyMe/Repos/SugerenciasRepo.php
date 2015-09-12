<?php namespace BuyMe\Repos;

 	use BuyMe\Entities\Keyword;

	class SugerenciasRepo extends BaseRepo{

		public function getModel(){

	        return new Keyword;
	    }  


		public function getAll(){

			return Keyword::where('Status','=','1');
		}

		public function getByKey($key,$user){

 
			return Keyword::where('Meta','=',$key)
						  ->where('Vendedor','=',$user)
						  ->first();
		}

		public function setDeleteKeywords($Vendedor){

			return Keyword::where('Vendedor','=',$Vendedor)
						  ->update(['Status' => 0]);
		}

		
		public function saveKeywords($data){

			$keywords = explode(',',$data['keywords']);

			$this->setDeleteKeywords($data['user']);

			foreach($keywords as $key){

				$keyword 	= $this->getByKey(trim($key),$data['user']);

			

			    if(!is_null($keyword)){

			    	$keyword->Status = 1;
			    	$keyword->save();

			    }

			    else{

			    	$keyword 		 	=  new Keyword;
					$keyword->Meta 	 	=  trim($key);
					$keyword->Status 	= 	1;
					$keyword->Vendedor	= $data['user'];
					$keyword->save();

			    }
				
			}

		}

		



	}