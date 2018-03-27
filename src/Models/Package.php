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
    public $itinerary;
    public $Category;
    public $Service;
    public $Image;
    public $Departure;
    public $Place;
    public $Price;
    public $Accommodation;
    public $Room;
    public $Company;
    public $Avail;
    public $PackagesSumarized;


  	/*
  	* @var Array Campos requeridos en el paquete
  	*/
  	private $required_fields = [
      // "Category",
      "services",
      "title",
      // "Image",
      "departure",
      "id",
      "places",
      "price",
      "accommodations",
      // "Room",
      "company", 
      // "transport",
      "total_nights"
    ];
    /**
     * Constructor
     * @param Array Listado de paquetes
     */
    public function __construct($package)
    { 
      // echo "<pre>";
      // print_r($package);
      // echo "</pre>";

      $packages_sumarized = [];
      if(array_key_exists('packages_sumarized', $package)){
          $packages_sumarized = $package['packages_sumarized'];
          $package = $package['package'];
      }    

      $packageKeys = array_keys($package);
      
      foreach ($this->required_fields as $required_field) {
    		if(!in_array($required_field,$packageKeys))
    		  throw new ValidationException("Falta el campo $required_field");
    	}
      $this->id = $package['id'];
      $this->title = $package['title'];
      $this->total_nights = $package['total_nights'];
      $this->transport = 1;

      if(!array_key_exists('observations', $package))
        $this->observations = '';
      else 
        $this->observations = $package['observations'];

      if(!array_key_exists('itinerary', $package))
        $this->itinerary = '';
      else 
        $this->itinerary = $package['itinerary'];
        
      $this->Category = [];
      // foreach ($package['Category'] as $key => $value) {
      $this->Category[] = new Category([]);
      // }
      $this->Service = [];
      foreach ($package['services'] as $key => $value) {
        $this->Service[] = new Service($value);
      }

      if(array_key_exists('departure', $package))
        $this->Departure = new Departure($package['departure']);
      else $this->Departure =[];
            
      $this->Place = [];
      foreach ($package['places'] as $key => $value) {
        $this->Place[] = new Place($value);
      }
      

      $this->Image = [];      
      foreach ($this->Place as $key => $place) {
        foreach ($place->images as $i => $image) {
          $this->Image[] = $image;
        }
      }

      $this->Room = [];

      foreach ($package['price']['room_prices'] as $room) {
        $this->Room[] = new Room($room,true);
      }
      
      if(array_key_exists('price', $package))
      $this->Price = new Price($package['price'], $this->Room);
  
      $this->Accommodation = [];
      foreach ($package['accommodations'] as $accommodation) {
        $this->Accommodation[] = new Accommodation($accommodation);
      }           

      if(array_key_exists('company', $package) && $package['company']){
            $this->Company = new Company($package['company']);
      } else {
            $this->Company = null;
      }      

      if(array_key_exists('avail', $package) && $package['avail']){
          $this->Avail = new Avail($package['avail']);
      } else {
          $this->Avail = null;
      }     

      if(count($packages_sumarized)>0){
          foreach ($packages_sumarized as $packages_sumarized__) {
            $this->PackagesSumarized[] = new PackagesSumarized($packages_sumarized__);
          }
      }else $this->PackagesSumarized = $packages_sumarized;
    }
}