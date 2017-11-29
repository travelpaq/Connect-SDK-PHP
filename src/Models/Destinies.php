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

/**
 * Class Destinies
 * 
 * Clase que contiene un listado de destinos
 *
 * @package TravelPAQ
 */
class Destinies
{
	/*
	* Lugares
	*/
	public $Places;
    
    /**
     * Constructor
     * @param Array Listado de paquetes desde la API
     */
    public function __construct($data)
    {
    	$this->Places = [];
    	foreach ($data as $key => $place) {
    		$this->Places[] = new City($place);
    	}
    }

}