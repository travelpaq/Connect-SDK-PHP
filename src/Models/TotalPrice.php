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
 * Class TotalPrice
 *
 * @package TravelPAQ
 */
class TotalPrice
{
	public $neto;
	public $tax;
	public $vat;
    /**
     * Constructor
     * @param Array data datos detallados de los impuesto del precio
     */
    public function __construct($data)
    {
    	if(!array_key_exists('neto', $data))
    		$data['neto'] = "";
    	$this->neto = $data['neto'];
 
 		if(!array_key_exists('tax', $data))
    		$data['tax'] = "";
    	$this->tax = $data['tax'];

 		if(!array_key_exists('vat', $data))
    		$data['vat'] = "";
    	$this->vat = $data['vat'];
 
    	
    }

}