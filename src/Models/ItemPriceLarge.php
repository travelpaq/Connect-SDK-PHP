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
	public $Description
	/*
    * @var float Base sobre la que se calcula el Rate.
    */
    public $Base
    /*
    * @var float Rate que se aplica sobre el rate
    */
    public $Rate
    /*
    * @var float Cantidad total del itemPrice.
    */
    public $Amount

    /**
     * Constructor
     * @param Array data datos del itemPrice
     */
    public function __construct($data)
    {
        if(!array_key_exists('Descrption', $data) && $data['Descrption'])
        	$data['Descrption'] = '';
        $this->Descrption = $data['Descrption'];

        if(!array_key_exists('Base', $data) && $data['Base'])
        	$data['Base'] = 0;
        $this->Base = $data['Base'];

        if(!array_key_exists('Rate', $data) && $data['Rate'])
        	$data['Rate'] = 0;
        $this->Rate = $data['Rate'];

        if(!array_key_exists('Amount', $data) && $data['Amount'])
        	$data['Amount'] = 0;
        $this->Amount = $data['Amount'];


    }

}