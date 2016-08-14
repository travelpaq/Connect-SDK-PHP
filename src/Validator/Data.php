<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Data;

class Data
{
	var $order_type;
	var $order_field;
	var $currency;
	var $origin_place;
	var $destination_place;
	var $month_departure;
	var $year_departure;
	var $Room;
	function __construct($params){
		if(array_key_exists('order_type', $params))
			$this->order_type = $params['order_type'];
		if(array_key_exists('order_field', $params))
			$this->order_field = $params['order_field'];
		if(array_key_exists('currency', $params))
			$this->currency = $params['currency'];
		if(array_key_exists('origin_place', $params))
			$this->origin_place = $params['origin_place'];
		if(array_key_exists('destination_place', $params))
			$this->destination_place = $params['destination_place'];
		if(array_key_exists('month_departure', $params))
			$this->month_departure = $params['month_departure'];
		if(array_key_exists('year_departure', $params))
			$this->year_departure = $params['year_departure'];
		$this->Room = [];

		if(array_key_exists('Room', $params))
			foreach($params['Room'] as $room){
				$this->Room[] = new Room($room);
			}
	}
}
