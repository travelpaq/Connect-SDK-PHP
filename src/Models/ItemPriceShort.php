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
	public $Description;
	/*
    * @var float Cantidad del itemPrice.
    */
    public $Amount;

    /**
     * Constructor
     * @param Array data datos del itemPrice
     */
    public function __construct($data)
    {
        if(!array_key_exists('Description', $data) && $data['Description'])
        	$data['Description'] = '';
        $this->Description = $data['Description'];

        if(!array_key_exists('Amount', $data) && $data['Amount'])
        	$data['Amount'] = 0;
        $this->Amount = (float)$data['Amount'];
    }

}