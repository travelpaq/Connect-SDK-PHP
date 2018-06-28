<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Group
{
	var $primary_group;
	var $secondary_group;

	function __construct($params){

		$agrupations=['hotel','hotel_regime','month_year','hotel_room_kind','place','departure_date'];

		if(array_key_exists('primary_group', $params)){
			$primary_groups = explode(',', (string)$params['primary_group']);
			foreach($primary_groups as $primary_group)
				if(!in_array($primary_group, $agrupations))
					throw new ValidationException("Alguno de los parámetros enviados como agrupamiento primario es inválido.");


			$this->primary_group = (string)$params['primary_group'];

		} else 
			throw new ValidationException("No se ha recibido agrupamiento primario.");

		if(array_key_exists('secondary_group', $params)){
			
			$secondary_groups = explode(',', (string)$params['secondary_group']);
			
			foreach($secondary_groups as $secondary_group)
				if(!in_array($secondary_group, $agrupations))
					throw new ValidationException("Alguno de los parámetros enviados como agrupamiento secundario es inválido.");

			foreach($primary_groups as $primary_group)
				foreach($secondary_groups as $secondary_group)
					if($primary_group === $secondary_group)
						throw new ValidationException("Los agrupamientos deben ser diferentes");

			$this->secondary_group = (string)$params['secondary_group'];

		} else {
			throw new ValidationException("No se ha recibido agrupamiento secundario.");
		}
	}
}
