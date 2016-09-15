<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Book;
use TravelPAQ\PackagesAPI\Validator\Passenger;

class Book
{
	var $package_fare_id;
	var $Passenger;
	
	function __construct($params) 
	{
		$this->Passenger = [];
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/input/bookingPackage.schema.json');
		if(array_key_exists('package_fare_id', $params))
			$this->package_fare_id = $params['package_fare_id'];
		else 
			throw new \Exception("No se ha especificado el identificador del paquete sobre el cual se desea realizar la reserva");
		
		if(array_key_exists('Passenger', $params))	
			foreach ($params['Passenger'] as $passenger)
				$this->Passenger[] = new Passenger($passenger);	
		else 
			throw new \Exception("No se han los pasajeros que viajarán con el paquete sobre el cual se desea realizar la reserva");
		echo '<pre>';
		var_dump($params);
		echo '</pre>';
		die();
	}
}
