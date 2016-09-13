<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Exceptions\ValidationException;
class Passenger
{
	var $name;
	var $surname;
	var $kind_doc;
	var $num_doc;
	var $gender;
	var $birthdate;
	var $residence;
	var $nationality;
	var $mail;
	var $tax_status;
	var $cuil;

	function __construct($params) 
	{
		if(array_key_exists('name', $params))
			$this->order_type = $params['name'];
		else 
			throw new ValidationException("No se ha recibido el nombre del pasajero");

		if(array_key_exists('surname', $params))
			$this->order_field = $params['surname'];
		else 
			throw new ValidationException("No se ha recibido el apellido del pasajero");

		if(array_key_exists('kind_doc', $params))
			$this->currency = $params['kind_doc'];
		else 
			throw new ValidationException("No se ha recibido el tipo de documento del pasajero");

		if(array_key_exists('num_doc', $params))
			$this->origin_place = $params['num_doc'];
		else 
			throw new ValidationException("No se ha recibido número de documento del pasajero");

		if(array_key_exists('gender', $params))
			$this->destination_place = $params['gender'];
		else 
			throw new ValidationException("No se ha recibido el género del pasajero");

		if(array_key_exists('birthdate', $params))
			$this->month_departure = $params['birthdate'];
		else 
			throw new ValidationException("No se ha recibido la fecha de nacimiento del pasajero");

		if(array_key_exists('residence', $params))
			$this->year_departure = $params['residence'];
		else 
			throw new ValidationException("No se ha recibido el país de recidencia del pasajero");

		if(array_key_exists('nationality', $params))
			$this->year_departure = $params['nationality'];
		else 
			throw new ValidationException("No se ha recibido la nacionalidad del pasajero");

		if(array_key_exists('mail', $params))
			$this->year_departure = $params['mail'];
		else 
			throw new ValidationException("No se ha recibido el mail del pasajero");
		if(array_key_exists('tax_satus', $params))
			$this->year_departure = $params['tax_satus'];
		else 
			throw new ValidationException("No se ha recibido la consición tributaria del pasajero");
		if(array_key_exists('cuil', $params))
			$this->year_departure = $params['cuil'];
		else 
			throw new ValidationException("No se ha recibido la consición tributaria del pasajero");


	}
}
