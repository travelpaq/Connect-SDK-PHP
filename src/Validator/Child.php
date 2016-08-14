<?php

namespace TravelPAQ\PackagesAPI\Validator;

class Child
{
    var $age; //int

	function __construct($params){
		$this->age = $params['age'];
	}
}