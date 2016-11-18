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
    public $star_rating;
    public $name;
    public $Place;
    public $required_fields = [
        "star_rating",
        "name",
        "Place"
    ];
    /**
     * Constructor
     * @param Array data datos de la salida
     */
    public function __construct($data)
    {

        $hotelKeys = array_keys($data);
        foreach ($this->required_fields as $required_field) {
            if(!in_array($required_field,$hotelKeys))
              throw new ValidationException("Falta el campo $required_field");
        }

        $this->Place = new Place($data['Place']);

        $this->name = $data['name'];
        
        $this->star_rating = $data['star_rating'];
    }

}