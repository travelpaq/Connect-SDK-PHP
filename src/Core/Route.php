<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   Facundo J Gonzalez <facujgg@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Core;

use TravelPAQ\PackagesAPI\Exceptions\ValidationException;
/**
 * Class Route
 *
 * @package TravelPAQ
 */
class Route
{
    var $direction;
    var $travel_number;
    var $arrival_time;
    var $order_number;
    var $departure_time;
	var $Route;
	var $DeparturePlace;
	var $TransportCompany;
	var $ArrivalPlace;
	
    /**
     * Constructor
     * @param Array data datos de la ruta
     */
    public function __construct($data)
    {
		$this->DeparturePlace = new Place($data['DeparturePlace']);

		$this->TransportCompany = new TransportCompany($data['TransportCompany']);

		$this->ArrivalPlace = new Place($data['ArrivalPlace']);

        if(!array_key_exists('direction', $data))
            $data['direction'] = "";
        $this->direction = $data['direction'];
		        
        if(!array_key_exists('travel_number', $data))
            $data['travel_number'] = "";
        $this->travel_number = $data['travel_number'];
		
        if(!array_key_exists('arrival_time', $data))
            $data['arrival_time'] = "";
        $this->arrival_time = $data['arrival_time'];
		        
        if(!array_key_exists('order_number', $data))
            $data['order_number'] = "";
        $this->order_number = $data['order_number'];
		
        if(!array_key_exists('departure_time', $data))
            $data['departure_time'] = "";
        $this->departure_time = $data['departure_time'];
    }

}