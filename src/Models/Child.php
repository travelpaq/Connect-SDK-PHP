<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Child
{
    var $age; //int

	function __construct($params){
		if(array_key_exists('age', $params))
			$this->age = (int)$params['age'];
		else 
			throw new ValidationException("No se ha especificado la edad de los uno de los Child que viajarán en los paquetes devueltos por la búsquedas");
	}
}