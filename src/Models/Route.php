<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   TravelPAQ <malves@travelpaq.com.ar>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
/**
 * Class Route
 *
 * @package TravelPAQ
 */
class Route
{
    public $direction;
    public $travel_number;
    public $arrival_time;
    public $arrival_date;
    public $order_number;
    public $departure_time;
    public $departure_date;
	public $DeparturePlace;
	public $TransportCompany;
	public $ArrivalPlace;
	
    /**
     * Constructor
     * @param Array data datos de la ruta
     */
    public function __construct($data,$key = false)
    {       

        if($key!==false){                   
            $this->order_number = ((int)$key)+1;
        }

        if(array_key_exists('departure_place',$data))
		  $this->DeparturePlace = new Place($data['departure_place']);
        else $this->DeparturePlace = [];

        if(array_key_exists('transport_company',$data))        
		  $this->TransportCompany = new TransportCompany($data['transport_company']);
        else $this->TransportCompany = [];

        if(array_key_exists('arrival_place',$data))                
		  $this->ArrivalPlace = new Place($data['arrival_place']);
        else $this->ArrivalPlace = [];
        
        if(!array_key_exists('direction', $data))
            $data['direction'] = 1;
        $this->direction = $data['direction'];
		        
        if(!array_key_exists('travel_number', $data))
            $data['travel_number'] = "";
        $this->travel_number = $data['travel_number'];
		
        if(!array_key_exists('arrival_time', $data))
            $data['arrival_time'] = "";
        $this->arrival_time = date('H:m',strtotime($data['arrival_time']));;

        if(!array_key_exists('arrival_date', $data))
            $data['arrival_date'] = "";
        $this->arrival_date = $data['arrival_date'];
		        
        // if(!array_key_exists('order_number', $data))
        //     $data['order_number'] = "";
        // $this->order_number = $data['order_number'];
		
        if(!array_key_exists('departure_time', $data))
            $data['departure_time'] = "";
        $this->departure_time = date('H:m',strtotime($data['departure_time']));

        if(!array_key_exists('departure_date', $data))
            $data['departure_date'] = "";
        $this->departure_date = $data['departure_date'];
    }

}