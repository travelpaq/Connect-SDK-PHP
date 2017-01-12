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
    public function __construct($data)
    {
    	if(!array_key_exists('age', $data))
            $data['age'] = 0;
        $this->age = $data['age'];
        parent::__construct($data);
    }

}