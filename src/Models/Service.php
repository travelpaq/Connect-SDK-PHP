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
 * Class Service
 *
 * @package TravelPAQ
 */
class Service
{
	public $detail;
	public $ServiceKind;
    /**
     * Constructor
     * @param Array data datos del servicio
     */
    public function __construct($data)
    {
    	if(!array_key_exists('detail', $data))
    		$data['detail'] = "";
    	$this->detail = $data['detail'];
    	$this->ServiceKind = new ServiceKind($data['ServiceKind']);
    }

}