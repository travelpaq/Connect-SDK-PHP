<?php

namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Group
{
	var $primary_group;
	var $secondary_group;

	function __construct($params){

		$agrupations=['hotel','hotel_regime','month_year','hote_room_kind','place','departure_date'];

		if(array_key_exists('primary_group', $params) && in_array($params['primary_group'], $agrupations))
			$this->primary_group = (string)$params['primary_group'];
		else 
			throw new ValidationException("No se ha recibido agrupamiento primario o es inválido.");

		if(array_key_exists('secondary_group', $params) && in_array($params['secondary_group'], $agrupations)){
			if((string)$params['primary_group'] !== (string)$params['secondary_group']){
				$this->secondary_group = (string)$params['secondary_group'];
			}else{
				throw new ValidationException("Los agrupamientos deben ser diferentes");
			}			
		}
		else {
			throw new ValidationException("No se ha recibido agrupamiento secundario o es inválido.");
		}

	}
}
