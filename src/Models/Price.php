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
 * Class Price
 *
 * @package TravelPAQ
 */
class Price
{
	public $currency;
        public $price_per_person;
        public $final_price;
        public $markup;
	public $Total_Price;
    /**
     * Constructor
     * @param Array data datos del precio
     */
    public function __construct($data)
    {
    	if(!array_key_exists('currency', $data))
    		$data['currency'] = "";
    	$this->currency = $data['currency'];
 
        if(!array_key_exists('price_per_person', $data))
            $data['price_per_person'] = "";
        $this->price_per_person = $data['price_per_person'];

        if(!array_key_exists('final_price', $data))
            $data['final_price'] = "";
        $this->final_price = $data['final_price'];

        if(!array_key_exists('markup', $data))
            $data['markup'] = "";
        $this->markup = $data['markup'];
 
    	$this->Total_Price = new Total_Price($data['Total_Price']);
    }

}