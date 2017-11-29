<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Room;
use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Search
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
		else 
			throw new ValidationException("No se ha recibido el tipo de orden del resultado de la búsqueda");

		if(array_key_exists('order_field', $params))
			$this->order_field = $params['order_field'];
		else 
			throw new ValidationException("No se ha recibido el campo que define el criterio de orden del resultado de la búsqueda");

		if(array_key_exists('currency', $params))
			$this->currency = $params['currency'];
		else 
			throw new ValidationException("No se ha recibido el tipo de moneda los paquetes devueltos por la búsqueda");

		if(array_key_exists('origin_place', $params)){
			if(is_array($params['origin_place']))
				$this->origin_place = $params['origin_place'];
			else {
				if($params['origin_place'])
					$this->origin_place = [$params['origin_place']];
				else 
					$this->origin_place = [];		
			}
		}
		else 
			$this->origin_place = [];

		if(array_key_exists('destination_place', $params)){
			if(is_array($params['destination_place']))
				$this->destination_place = $params['destination_place'];
			else {
				if($params['destination_place'])
					$this->destination_place = [$params['destination_place']];
				else 
					$this->destination_place = [];
			}
		}
		else 
			$this->destination_place = [];

		if(array_key_exists('month_departure', $params))
			$this->month_departure = (int)$params['month_departure'];
		else 
			$this->month_departure = 0;

		if(array_key_exists('year_departure', $params))
			$this->year_departure = (int)$params['year_departure'];
		else 
			$this->year_departure = 0;
		
		$this->Room = [];
		if(array_key_exists('Room', $params))
			if(array_key_exists(0, $params['Room']) && count($params['Room']) > 0){
				foreach ($params['Room'] as $room) {
					$this->Room[] = new Room($room);	
				}
			} else 
				$this->Room[] = new Room(['adult' => 2, 'Children' => []]);
		else 
			$this->Room[] = new Room(['adult' => 2, 'Children' => []]);
	}
}
