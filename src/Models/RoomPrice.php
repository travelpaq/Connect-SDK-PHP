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
        if(array_key_exists('adult_price',$data))
    	   $this->AdultPrice = new AdultPrice($data['adult_price']);
        
        if(array_key_exists('total_price',$data))        
            $this->TotalPrice = new TotalPrice($data['total_price']);

        $this->ChildrenPrice = [];
        if(array_key_exists('children_prices', $data) && count($data['children_prices']) > 0){
            foreach($data['children_prices'] as $childPrice){
                $this->ChildrenPrice[] = new ChildPrice($childPrice);
            }
        }

        $this->Room = $room;

        if(!array_key_exists('final_price', $data))
            $data['final_price'] = 0;
        $this->final_price = $data['final_price'];
    }

}