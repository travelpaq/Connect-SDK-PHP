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
 * Class AdultPrice
 *
 * @package TravelPAQ
 */
class AdultPrice
{
    public $adult;
    public $final_price;
    public $TotalPrice;
    public function __construct($data)
    {
    	if(!array_key_exists('adult', $data))
            $data['adult'] = 0;
        $this->adult = (int)$data['adult'];

        if(!array_key_exists('final_price', $data))
            $data['final_price'] = 0;
        $this->final_price = $data['final_price'];

        $this->TotalPrice = new TotalPrice($data['TotalPrice']);
    }

}