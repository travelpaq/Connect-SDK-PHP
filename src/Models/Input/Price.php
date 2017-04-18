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
namespace TravelPAQ\PackagesAPI\Models\Input;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
/**
 * Class Price
 *
 * @package TravelPAQ
 */
class Price
{
    public $Adult;
    public $Children;
    /**
     * Constructor
     * @param Array data datos del precio
     */
    public function __construct($data)
    {
        $this->Adult = [];
        foreach($data['Adult'] as $i => $price){
            $this->Adult[] = new AdultPrice($price);
        }

        $this->Children = [];
        foreach($data['Children'] as $i => $price){
            $this->Children[] = new ChildrenPrice($price);
        }
    }

}