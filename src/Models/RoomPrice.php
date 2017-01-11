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
 * Class RoomPrice
 *
 * @package TravelPAQ
 */
class RoomPrice
{
	public $AdultPrice;
    public $ChildrenPrice;
    public $Room;
    /**
     * Constructor
     * @param Array data datos del precio
     */
    public function __construct($data, room)
    {
    	$this->AdultPrice = new TotalPrice($data['AdultPrice']);

        if(count($data['ChildrenPrice']) > 0){
            foreach($data['ChildrenPrice'] as $childPrice){
                $this->ChildrenPrice = new TotalPrice($childPrice)
            }
        } else {
            $this->ChildrenPrice = [];
        }

        $this->Room = $room;
    }

}