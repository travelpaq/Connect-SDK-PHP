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
 * Class Place
 *
 * @package TravelPAQ
 */
class Place
{
	public $name;
	public $iata;
    public $Country;
    /**
     * Constructor
     * @param Array data datos de un lugar de un tramo de una ruta
     */
    public function __construct($data)
    {
        $this->Country = new Country($data['Country']);
    	
        if(!array_key_exists('name', $data))
    		$data['name'] = "";
    	$this->name = $data['name'];
    	
    	if(!array_key_exists('iata', $data))
    		$data['iata'] = "";
    	$this->iata = $data['iata'];
    }

}