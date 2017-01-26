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
 * Class Pricing
 *
 * @package TravelPAQ
 */
class ItemPriceShort
{
	/*
    * @var string Descripción del precio.
    */
	public $description;
	/*
    * @var float Cantidad del itemPrice.
    */
    public $amount;

    /**
     * Constructor
     * @param Array data datos del itemPrice
     */
    public function __construct($data)
    {
        if(!array_key_exists('description', $data) && $data['description'])
        	$data['description'] = '';
        $this->description = $data['description'];

        if(!array_key_exists('amount', $data) && $data['amount'])
        	$data['amount'] = 0;
        $this->amount = (float)$data['amount'];
    }

}