<?php

namespace TravelPAQ\PackagesAPI\Models;
use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

class Room
{
    var $adult; //int
    var $Children; //int
	function __construct($params,$n = false){
		if($n){
			// **v3
			if(array_key_exists('adult_price', $params) && array_key_exists('adult', $params['adult_price']))
				$this->adult = (int)($params['adult_price']['adult']);
			else 
				throw new ValidationException("No se ha recibido el número de adultos que viajarán en los paquetes devueltos por la búsquedas");		

			$this->Children = [];
			if(array_key_exists('children_prices', $params)){
				foreach ($params['children_prices'] as $child) {
					$this->Children[] = new Child($child,true);	
				}				 
			} 	
		}else{
			if(array_key_exists('adult', $params))
				$this->adult = (int)($params['adult']);
			else 
				throw new ValidationException("No se ha recibido el número de adultos que viajarán en los paquetes devueltos por la búsquedas");
			

			$this->Children = [];
			if(array_key_exists('Children', $params)){
				if(array_key_exists(0, $params['Children']) && count($params['Children']) > 0){
					foreach ($params['Children'] as $child) {
						$this->Children[] = new Child($child);	
					}
				} 
			} 	
		}

		
	}
}