<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Book
{
	var $package_id;
	var $contact_phone;
	var $Room;
	
	function __construct($params)
	{
		$this->Room = [];
		if(array_key_exists('package_id', $params))
			$this->package_id = $params['package_id'];
		else 
			throw new ValidationException("No se ha especificado el identificador del paquete sobre el cual se desea realizar la reserva");

		if(array_key_exists('contact_phone', $params))
			$this->contact_phone = (string)($params['contact_phone']);
		else 
			throw new ValidationException("No se ha especificado el telefono de contacto para la reserva");
		
		if(array_key_exists('Room', $params))	
			foreach ($params['Room'] as $i => $room){
				
				$this->Room[] = [];
				foreach ($room as $passenger)
					$this->Room[$i][] = new Passenger($passenger);	
			}
		else 
			throw new ValidationException("No se han los pasajeros que viajarán con el paquete sobre el cual se desea realizar la reserva");
	}
}
