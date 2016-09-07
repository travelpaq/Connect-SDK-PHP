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
 * Class Place
 *
 * @package TravelPAQ
 */
class Place
{
	public $name;
	public $iata;
    /**
     * Constructor
     * @param Array data datos de un lugar de un tramo de una ruta
     */
    public function __construct($data)
    {
    	if(!array_key_exists('name', $data))
    		$data['name'] = "";
    	$this->name = $data['name'];
    	
    	if(!array_key_exists('iata', $data))
    		$data['iata'] = "";
    	$this->iata = $data['iata'];
    	
    }

}