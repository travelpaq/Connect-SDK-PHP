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
 * Class Package
 *
 * @package TravelPAQ
 */
class Package
{
	/*
	* @var Array Campos requeridos en el paquete
	*/
	var $required_fields = [
      "Category",
      "Service",
      "title",
      "Image",
      "Departure",
      "id",
      "Place",
      "Price",
      "Accommodation",
      "transport"
    ];
    /**
     * Constructor
     * @param Array Listado de paquetes
     */
    public function __construct($package)
    {
    	foreach ($package as $key => $value) {
    		if(!in_array($key, $required_fields))
    			throw new ValidationException("Falta el campo $key");
    	}
      $this->id = $package['id'];
      $this->title = $package['title'];
      $this->transport = $package['transport'];
      $this->Category = [];
      foreach ($package['Category'] as $key => $value) {
        $this->Category = new Category($value);
      }
      $this->Service = [];
      foreach ($package['Service'] as $key => $value) {
        $this->Service = new Service($value);
      }
       
    }
}