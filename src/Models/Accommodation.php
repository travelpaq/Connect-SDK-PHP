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
	public $Hotel;
    private $required_fields = [
        "number_nights",
        "check_in",
        "check_out",
        "type_room",
        "hotel_service",
        "Hotel"
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


        $this->type_room = $data['type_room'];

        $this->hotel_service = $data['hotel_service'];

		$this->Hotel = new Hotel($data['Hotel']);

    }

}