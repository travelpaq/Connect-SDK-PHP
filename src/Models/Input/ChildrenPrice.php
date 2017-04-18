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
 * Class ChildrenPrice
 *
 * @package TravelPAQ
 */
class ChildrenPrice
{
    public $currency;
    public $neto;
    public $tax;
    public $vat;
    public $max_number_children;
    public $age_from;
    public $age_to;
    public $number_order;
    public $type_fare_support;

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
    		$data['neto'] = "";
    	$this->neto = (int)$data['neto'];

    	if(!array_key_exists('base', $data))
    		$data['base'] = "";
    	$this->base = (int)$data['base'];
 
 		if(!array_key_exists('tax', $data))
    		$data['tax'] = "";
    	$this->tax = (int)$data['tax'];

 		if(!array_key_exists('vat', $data))
    		$data['vat'] = "";
    	$this->vat = (int)$data['vat'];

		if(!array_key_exists('max_number_children', $data))
    		$data['max_number_children'] = "";
    	$this->max_number_children = (int)$data['max_number_children'];    	

    	if(!array_key_exists('age_from', $data))
    		$data['age_from'] = "";
    	$this->age_from = (int)$data['age_from'];    	

    	if(!array_key_exists('age_to', $data))
    		$data['age_to'] = "";
    	$this->age_to = (int)$data['age_to'];    	

    	if(!array_key_exists('number_order', $data))
    		$data['number_order'] = "";
    	$this->number_order = (int)$data['number_order'];    	

    	if(!array_key_exists('type_fare_support', $data))
    		$data['type_fare_support'] = "";
    	$this->type_fare_support = (int)$data['type_fare_support'];    	
 
    }

}