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
namespace TravelPAQ\PackagesAPI\Models\Input;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
use TravelPAQ\PackagesAPI\Models\Category;
use TravelPAQ\PackagesAPI\Models\Service;
use TravelPAQ\PackagesAPI\Models\Departure;
use TravelPAQ\PackagesAPI\Models\Accommodation;
use TravelPAQ\PackagesAPI\Models\Avail;
use TravelPAQ\PackagesAPI\Models\Company;
use TravelPAQ\PackagesAPI\Models\Place;
/**
 * Class Package
 *
 * @package TravelPAQ
 */
class Package
{
    public $id;
    public $title;
    public $observations;
    public $itinerary;
    public $expiration_date;
    public $Category;
    public $Service;
    public $Departure;
    public $Place;
    public $Price;
    public $Company;
    public $Accommodation;
    public $Avail;

    /**
     * Constructor
     * @param Array Listado de paquetes
     */

    public function __construct($package)
    {


    	if(!array_key_exists('id', $package))
    		$this->id = "";
		  else 
			 $this->id = $package['id'];
    
    	if(!array_key_exists('title', $package))
    		$this->title = '';
		  else 
			 $this->title = $package['title'];

      if(!array_key_exists('observations', $package))
        $this->observations = '';
      else 
        $this->observations = $package['observations'];

      if(!array_key_exists('itinerary', $package))
        $this->itinerary = '';
      else 
        $this->itinerary = $package['itinerary'];

      if(!array_key_exists('expiration_date', $package))
        $this->expiration_date = '0000-00-00';
      else {
        $date = explode('/',$package['expiration_date']);
        if(count($date) == 3){
            $package['expiration_date'] = $date[2] . "-" . $date[1] . "-" . $date[0];
        }
        $this->expiration_date = $package['expiration_date'];
      }
      
       $this->Category = [];
       foreach ($package['Category'] as $key => $value) {
         $this->Category[] = new Category($value);
       }
    
      $this->Service = [];
      foreach ($package['Service'] as $key => $value) {
        $this->Service[] = new Service($value);
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

      if(array_key_exists('Company', $package) && $package['Company']){
            $this->Company = new Company($package['Company']);
        } else {
            $this->Company = null;
        }

      if(array_key_exists('Avail', $package) && $package['Avail']){
          $this->Avail = new Avail($package['Avail']);
      } else {
          $this->Avail = null;
      }

    }
}