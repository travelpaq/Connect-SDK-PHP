<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Child
{
    var $age; //int

	function __construct($params,$n = false){

		if($n){
			// **v3
			if(array_key_exists('age_from', $params))
				$this->age = (int)$params['age_from'];
		}else{
			if(array_key_exists('age', $params))
				$this->age = (int)$params['age'];
			else 
				throw new ValidationException("No se ha especificado la edad de los uno de los Child que viajarán en los paquetes devueltos por la búsquedas");	
		}

		

	}
}