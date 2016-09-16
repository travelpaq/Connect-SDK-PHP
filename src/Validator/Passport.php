<?php

namespace TravelPAQ\PackagesAPI\Validator;

class Passport
{
	var $number;
	var $expiration_date;
	
	function __construct($params) 
	{
		if(array_key_exists('number', $params))	
			$this->number = $params['number'];
		else 
			throw new \Exception("No se ha encontrado el número de pasaporte del pasajero");

		if(array_key_exists('expiration_date', $params))	
			$this->number = $params['expiration_date'];
		else 
			throw new \Exception("No se ha encontrado la fecha de expiración de pasaporte del pasajero");
	}
}
