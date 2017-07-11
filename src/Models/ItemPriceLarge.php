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
class ItemPriceLarge
{
    /*
    * @var string Descripción del precio.
    */
    public $description;
    /*
    * @var float Base sobre la que se calcula el Rate.
    */
    public $base;
    /*
    * @var float Rate que se aplica sobre la base
    */
    public $rate;
    /*
    * @var float Cantidad total del itemPrice.
    */
    public $amount;

    /**
     * Constructor
     * @param Array data datos del itemPrice
     */
    public function __construct($data)
    {
        if(!array_key_exists('description', $data)){
            if(!array_key_exists('Description', $data))
               $data['description'] = '';
            else 
                $data['description'] = $data['Description'];
        }
        $this->description = $data['description'];

        if(!array_key_exists('base', $data)){
            if(!array_key_exists('Base', $data))
                $data['base'] = 0;
            else 
                $data['base'] = $data['Base'];
        }
        $this->base = (float)$data['base'];

        if(!array_key_exists('rate', $data)){
            if(!array_key_exists('Rate', $data))
                $data['rate'] = 0;
            else 
                $data['rate'] = $data['Rate'];
        }
        $this->rate = (float)$data['rate'];

        if(!array_key_exists('amount', $data)){
            if(!array_key_exists('Amount', $data))
                $data['amount'] = 0;
            else 
                $data['amount'] = $data['Amount'];
        }
        $this->amount = (float)$data['amount'];


    }

}