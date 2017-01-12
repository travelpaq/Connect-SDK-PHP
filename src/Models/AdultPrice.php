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
class AdultPrice extends TotalPrice
{
    public $adult;
    public function __construct($data)
    {
    	if(!array_key_exists('adult', $data))
            $data['adult'] = 0;
        $this->adult = $data['adult'];
        parent::__construct($data);
    }

}