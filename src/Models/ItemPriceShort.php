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
        if(!array_key_exists('description', $data)){
            if(!array_key_exists('Description', $data))
               $data['description'] = '';
            else 
                $data['description'] = $data['Description'];
        }
        $this->description = $data['description'];

        if(!array_key_exists('amount', $data)){
            if(!array_key_exists('amount', $data))
                $data['amount'] = 0;
            else 
                $data['amount'] = $data['amount'];
        }
        $this->amount = (float)$data['amount'];
    }

}