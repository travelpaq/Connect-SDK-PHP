<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Child;

class Room
{
    var $adult; //int
    var $Children; //array(Child)
	function __construct($params){
		$this->adult = $params['adult'];
		$this->Children = [];
		foreach($params['Children'] as $child){
			$this->Children[] = new Child($child);
		}
	}
}