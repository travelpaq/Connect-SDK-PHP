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
 * Class ChildPrice
 *
 * @package TravelPAQ
 */
class ChildPrice
{
    public $age_from;
    public $age_to;
    public $final_price;
    public $TotalPrice;
    public function __construct($data)
    {
        if(!array_key_exists('age_from', $data))
            $data['age_from'] = 0;
        $this->age_from = (int)$data['age_from'];
        if(!array_key_exists('age_to', $data))
            $data['age_to'] = 0;
        $this->age_to = (int)$data['age_to'];

        if(!array_key_exists('final_price', $data))
            $data['final_price'] = 0;
        $this->final_price = $data['final_price'];

        $this->TotalPrice = new TotalPrice($data['TotalPrice']);
    }
}