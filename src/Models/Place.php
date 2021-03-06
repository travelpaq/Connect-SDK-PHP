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
    public $images;
    /**
     * Constructor
     * @param Array data datos de un lugar de un tramo de una ruta
     */
    public function __construct($data)
    {           
        if(array_key_exists('country', $data))
            $this->Country = new Country($data['country']);
        else $this->Country = [];
    	
        if(!array_key_exists('name', $data))
    		$data['name'] = "";
    	$this->name = $data['name'];
    	
    	if(!array_key_exists('iata', $data))
    		$data['iata'] = "";
    	$this->iata = $data['iata'];

        $this->images = [];
        if(array_key_exists('images', $data)){
            foreach ($data['images'] as $i => $image) {
                $this->images[] = new Image($image);                
            }                        
        }

    }

}