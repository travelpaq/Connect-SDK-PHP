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
    public $TotalPrice;
    public $Room;
    public $final_price;
    /**
     * Constructor
     * @param Array data datos del precio
     */
    public function __construct($data, $room)
    {
    	$this->AdultPrice = new AdultPrice($data['AdultPrice']);

        $this->TotalPrice = new TotalPrice($data['TotalPrice']);

        if(count($data['ChildrenPrice']) > 0){
            foreach($data['ChildrenPrice'] as $childPrice){
                $this->ChildrenPrice[] = new ChildPrice($childPrice);
            }
        } else {
            $this->ChildrenPrice = [];
        }

        $this->Room = $room;

        if(!array_key_exists('final_price', $data))
            $data['final_price'] = 0;
        $this->final_price = $data['final_price'];
    }

}