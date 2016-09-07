<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Room;

class Filter
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
			throw new \Exception("No se ha recibido el tipo de orden del resultado de la búsqueda");

		if(array_key_exists('order_field', $params))
			$this->order_field = $params['order_field'];
		else 
			throw new \Exception("No se ha recibido el campo que define el criterio de orden del resultado de la búsqueda");

		if(array_key_exists('currency', $params))
			$this->currency = $params['currency'];
		else 
			throw new \Exception("No se ha recibido el tipo de moneda los paquetes devueltos por la búsqueda");

		if(array_key_exists('origin_place', $params))
			$this->origin_place = $params['origin_place'];
		else 
			throw new \Exception("No se ha recibido el lugar de salida de los paquetes devueltos por la búsqueda");

		if(array_key_exists('destination_place', $params))
			$this->destination_place = $params['destination_place'];
		else 
			throw new \Exception("No se ha recibido el destino de los paquetes devueltos por la búsqueda");

		if(array_key_exists('month_departure', $params))
			$this->month_departure = $params['month_departure'];
		else 
			throw new \Exception("No se ha recibido el mes de salida de los paquetes devueltos por la búsquedas");

		if(array_key_exists('year_departure', $params))
			$this->year_departure = $params['year_departure'];
		else 
			throw new \Exception("No se ha recibido el año de salida de los paquetes devueltos por la búsquedas");
		
		$this->Room = [];

		if(array_key_exists('Room', $params))
			foreach($params['Room'] as $room){
				$this->Room[] = new Room($room);
			}
	}
}