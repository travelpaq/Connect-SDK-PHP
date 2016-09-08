<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Child;

class Room
{
    var $adult; //int
    var $Children; //array(Child)
	function __construct($params){
		if(array_key_exists('adult', $params))
			$this->adult = $params['adult'];
		else 
			throw new ValidationException("No se ha recibido el número de adultos que viajarán en los paquetes devueltos por la búsquedas");

		if(array_key_exists('Children', $params))
		{
			$this->Children = [];
			foreach($params['Children'] as $child){
				$this->Children[] = new Child($child);
			}
		}
		else 
			throw new ValidationException("No se ha recibido el conjunto de Children que viajarán en los paquetes devueltos por la búsquedas");
	}
}