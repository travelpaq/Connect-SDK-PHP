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
 * Class Hotel
 *
 * @package TravelPAQ
 */
class Hotel
{
    public $date;    
    public $check_in;
    public $check_out;
    public $star_rating;
    public $name;
    public $type_room;
    public $hotel_service;
    public $max_num_child;
    public $childre_age;
    public $Place;
    /**
     * Constructor
     * @param Array data datos de la salida
     */
    public function __construct($data)
    {

        $this->Place = new Place($data['Place']);

        if(!array_key_exists('name', $data))
            $data['name'] = "";
        $this->name = $data['name'];
        
        if(!array_key_exists('check_in', $data))
            $data['check_in'] = "";
        $this->check_in = $data['check_in'];
        
        if(!array_key_exists('check_out', $data))
            $data['check_out'] = "";
        $this->check_out = $data['check_out'];
        
        if(!array_key_exists('star_rating', $data))
            $data['star_rating'] = "";
        $this->star_rating = $data['star_rating'];
        
        if(!array_key_exists('type_room', $data))
            $data['type_room'] = "";
        $this->type_room = $data['type_room'];
        
        if(!array_key_exists('hotel_service', $data))
            $data['hotel_service'] = "";
        $this->hotel_service = $data['hotel_service'];

        if(!array_key_exists('max_num_child', $data))
            $data['max_num_child'] = 0;
        $this->max_num_child = $data['max_num_child'];

        if(!array_key_exists('childre_age', $data))
            $data['childre_age'] = 0;
        $this->childre_age = $data['childre_age'];
    }

}