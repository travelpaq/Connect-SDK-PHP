<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Room;
use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Filter
{
	var $name;
	var $from;
	var $to;
	function __construct($params){
		if(array_key_exists('name', $params))
			$this->name = (string)$params['name'];
		else 
			throw new ValidationException("No se ha recibido el nombre del filtro");

		if(array_key_exists('from', $params))
			$this->from = (string)$params['from'];
		else 
			throw new ValidationException("No se ha recibido el límite inferior del filtro");

		if(array_key_exists('to', $params))
			$this->to = (string)$params['to'];
		else 
			throw new ValidationException("No se ha recibido el límite superior del filtro");
	}
}
