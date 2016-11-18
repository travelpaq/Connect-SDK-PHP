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
class Package
{
    public $id;
    public $title;
    public $total_nights;
    public $transport;
    public $observations;
    public $Category;
    public $Service;
    public $Image;
    public $Departure;
    public $Place;
    public $Price;
    public $Accommodation;
    public $Room;
    public $Company;
  	/*
  	* @var Array Campos requeridos en el paquete
  	*/
  	private $required_fields = [
      "Category",
      "Service",
      "title",
      "Image",
      "Departure",
      "id",
      "Place",
      "Price",
      "Accommodation",
      "Room",
      //"Company", 
      "transport",
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
      $this->transport = $package['transport'];

      if(!array_key_exists('observations', $package)
        $this->observations = '';
      else 
        $this->observations = $package['observations'];
        
      $this->Category = [];
      foreach ($package['Category'] as $key => $value) {
        $this->Category[] = new Category($value);
      }
      
      $this->Service = [];
      foreach ($package['Service'] as $key => $value) {
        $this->Service[] = new Service($value);
      }
      
      $this->Image = [];
      foreach ($package['Image'] as $key => $value) {
        $this->Image[] = new Image($value);
      }

      $this->Departure = new Departure($package['Departure']);

      $this->Place = [];
      foreach ($package['Place'] as $key => $value) {
        $this->Place[] = new Place($value);
      }

      $this->Price = new Price($package['Price']);

      $this->Accommodation = [];
      foreach ($package['Accommodation'] as $accommodation) {
        $this->Accommodation[] = new Accommodation($accommodation);
      }
      
      
      $this->Room = new Room($package['Room']);

      if(array_key_exists('Company', $package) && $package['Company']){
            $this->Company = new Company($package['Company']);
        } else {
            $this->Company = null;
        }

    }
}