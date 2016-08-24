<?php

namespace TravelPAQ\PackagesAPI\Validator;

class Passenger
{
	var $name;
	var $surname;
	function __construct($params) 
	{
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/bookingPackage.schema.json');
		$this->data = new Book($params);
	}
}
