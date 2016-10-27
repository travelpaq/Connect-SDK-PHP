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
 * Class TransportCompany
 *
 * @package TravelPAQ
 */
class TransportCompany
{
	public $name;
    /**
     * Constructor
     * @param Array data datos la compañia de transporte
     */
    public function __construct($data)
    {
    	if(!array_key_exists('name', $data))
    		$data['name'] = "";
    	$this->name = $data['name'];
    }

}