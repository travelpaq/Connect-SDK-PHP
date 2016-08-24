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
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/bookingPackage.schema.json');
		$this->package_fare_id = $params['package_fare_id'];
		foreach ($params['Passenger'] as $passenger)
		{
			try 
			{
				$this->Passenger[] = new Passenger($passenger);	
			}
			catch(Exception $e)
			{
				return json_encode(array('status' => 'ERROR'));
			}
		}
	}
}
