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
class ChildPrice extends TotalPrice
{
    public $age;
    public $age_from;
    public $age_to;
    public function __construct($data)
    {
        if(!array_key_exists('age_from', $data))
            $data['age_from'] = 0;
        $this->age_from = $data['age_from'];
        if(!array_key_exists('age_to', $data))
            $data['age_to'] = 0;
        $this->age_to = $data['age_to'];
        parent::__construct($data);
    }
}