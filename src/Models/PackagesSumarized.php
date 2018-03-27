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
 * Class Package
 *
 * @package TravelPAQ
 */
class PackagesSumarized
{
    public $id;
    public $title;
    public $currency;
    public $final_price;
    public $total_nights;
    public $Departure;
    public $Place;
    public $Accommodation;

  	/*
  	* @var Array Campos requeridos en el paquete
  	*/
  	private $required_fields = [
      "title",
      "departure",
      "id",
      "places",
      "price",
      "accommodations",
      "total_nights"
    ];
    /**
     * Constructor
     * @param Array Listado de paquetes
     */
    public function __construct($package)
    {      
      $packageKeys = array_keys($package);
      
      foreach ($this->required_fields as $required_field) {
    		if(!in_array($required_field,$packageKeys))
    		  throw new ValidationException("Falta el campo $required_field");
    	}
      $this->id = $package['id'];
      $this->title = $package['title'];
      $this->total_nights = $package['total_nights'];
      $this->currency = $package['price']['currency'];
      $this->final_price = $package['price']['final_price'];
      
      if(array_key_exists('departure', $package))
        $this->Departure = new Departure($package['departure']);
      else $this->Departure =[];
            
      $this->Place = [];
      foreach ($package['places'] as $key => $value) {
        $this->Place[] = new Place($value);
      }                  
  
      $this->Accommodation = [];
      foreach ($package['accommodations'] as $accommodation) {
        $this->Accommodation[] = new Accommodation($accommodation);
      }                 
      
      if(array_key_exists('avail', $package) && $package['avail']){
          $this->Avail = new Avail($package['avail']);
      } else {
          $this->Avail = null;
      }
    }
}