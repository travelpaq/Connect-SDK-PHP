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
	var $Passport;

	function __construct($params) 
	{
		if(array_key_exists('name', $params))
			$this->name = $params['name'];
		else 
			throw new ValidationException("No se ha recibido el nombre del pasajero");

		if(array_key_exists('surname', $params))
			$this->surname = $params['surname'];
		else 
			throw new ValidationException("No se ha recibido el apellido del pasajero");

		if(array_key_exists('kind_doc', $params))
			$this->kind_doc = $params['kind_doc'];
		else 
			throw new ValidationException("No se ha recibido el tipo de documento del pasajero");

		if(array_key_exists('num_doc', $params))
			$this->num_doc = $params['num_doc'];
		else 
			throw new ValidationException("No se ha recibido número de documento del pasajero");

		if(array_key_exists('gender', $params))
			$this->gender = $params['gender'];
		else 
			throw new ValidationException("No se ha recibido el género del pasajero");

		if(array_key_exists('birthdate', $params))
			$this->birthdate = $params['birthdate'];
		else 
			throw new ValidationException("No se ha recibido la fecha de nacimiento del pasajero");

		if(array_key_exists('residence', $params))
			$this->residence = $params['residence'];
		else 
			throw new ValidationException("No se ha recibido el país de recidencia del pasajero");

		if(array_key_exists('nationality', $params))
			$this->nationality = $params['nationality'];
		else {
			throw new ValidationException("No se ha recibido la nacionalidad del pasajero");
		}
		if(array_key_exists('mail', $params))
			$this->mail = $params['mail'];
		else 
			throw new ValidationException("No se ha recibido el mail del pasajero");
		if($this->kind_doc == 'Pasaporte') {
			if(array_key_exists('Passport', $params))
				$this->Passport = new Passport($params['Passport']);
			else 
				throw new ValidationException("No se ha recibido el Pasaporte del pasajero");
		} 
	}
}