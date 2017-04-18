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
/**
 * Class AdultPrice
 *
 * @package TravelPAQ
 */
class AdultPrice
{
    public $currency;
    public $neto;
    public $base;
    public $tax;
    public $vat;
    public $max_number_children;

    /**
     * Constructor
     * @param Array data datos del precio
     */
    public function __construct($data)
    {
    	if(!array_key_exists('currency', $data))
    		$data['currency'] = "";
    	$this->currency = $data['currency'];

    	if(!array_key_exists('neto', $data))
    		$data['neto'] = 0;
    	$this->neto = (int)$data['neto'];

    	if(!array_key_exists('base', $data))
    		$data['base'] = 0;
    	$this->base = (int)$data['base'];
 
 		if(!array_key_exists('tax', $data))
    		$data['tax'] = 0;
    	$this->tax = (int)$data['tax'];

 		if(!array_key_exists('vat', $data))
    		$data['vat'] = 0;
    	$this->vat = (int)$data['vat'];

		if(!array_key_exists('max_number_children', $data))
    		$data['max_number_children'] = 0;
    	$this->max_number_children = (int)$data['max_number_children'];    	
 
    }

}