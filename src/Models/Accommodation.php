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
 * Class Accommodation
 *
 * @package TravelPAQ
 */
class Accommodation
{
    public $number_nights;
    public $check_in;
    public $check_out;
    public $type_room;
    public $hotel_service;
    public $room_kind;
    public $regime;
	public $Hotel;
    private $required_fields = [
        "number_nights",
        "check_in",
        "check_out",
        'regime',
        'room_kind',
        // "type_room",
        // "hotel_service",
        "hotel"
    ];
    /**
     * Constructor
     * @param Array data datos del hospedaje
     */
    public function __construct($data)
    {

        $accommodationKeys = array_keys($data);
        foreach ($this->required_fields as $required_field) {
            if(!in_array($required_field,$accommodationKeys))
              throw new ValidationException("Falta el campo $required_field");
        }

        $this->number_nights = $data['number_nights'];

        $date = explode('/', $data['check_in']);
        if(count($date) == 3){
            $data['check_in'] = $date[2] . "-" . $date[1] . "-" . $date[0];
        }
        $this->check_in = $data['check_in'];

        $date = explode('/', $data['check_out']);
        if(count($date) == 3){
            $data['check_out'] = $date[2] . "-" . $date[1] . "-" . $date[0];
        }
        $this->check_out = $data['check_out'];

        if(array_key_exists('room_kind', $data)){
            if(array_key_exists('name', $data['room_kind'])){
                $this->type_room = $data['room_kind']['name'];            
                $this->room_kind = new RoomKind($data['room_kind']);
            }
        }

        if(array_key_exists('regime', $data)){
            if(array_key_exists('name', $data['regime'])){
                $this->hotel_service = $data['regime']['name'];            
                $this->regime = new Regime($data['regime']);
            }
        }        
        if(array_key_exists('hotel', $data))
		  $this->Hotel = new Hotel($data['hotel']);
        else $this->Hotel = [];
    }

}