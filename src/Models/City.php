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
namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
/**
 * Class Place
 *
 * @package TravelPAQ
 */
class City extends Place implements \JsonSerializable
{
	public $name;
	public $iata;
    public $Country;
    public $number_nights;
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

    public function jsonSerialize() {
        return [
        	'name' => $this->name,
        	'iata' => $this->iata,
        	'Country' => $this->Country
		];
    }

}