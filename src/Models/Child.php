<?php

namespace TravelPAQ\PackagesAPI\Models;

class Child
{
    var $age; //int

	function __construct($params){
		if(array_key_exists('age', $params))
			$this->age = (int)$params['age'];
		else 
			throw new \Exception("No se ha especificado la edad de los uno de los Child que viajarán en los paquetes devueltos por la búsquedas");
	}
}