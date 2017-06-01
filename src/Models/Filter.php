<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Room;
use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Filter
{
	var $name;
	var $from;
	var $to;
	var $companies;
	function __construct($params){
		if(array_key_exists('name', $params))
			$this->name = (string)$params['name'];
		else 
			throw new ValidationException("No se ha recibido el nombre del filtro");

		if(array_key_exists('from', $params) && array_key_exists('to', $params)){
			$this->from = (string)$params['from'];
			$this->to = (string)$params['to'];
			$this->companies = [];
		} else {
			$this->from = "";
			$this->to = "";
			if(array_key_exists('companies', $params))
				$this->companies = $params['companies'];
			else 
				$this->companies = [];
		}	
	}
}
