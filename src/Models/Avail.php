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
 * Class Avail
 *
 * @package TravelPAQ
 */
class Avail
{
    public $seats;
    public $rooms;
    public $last_update;
    /**
     * Constructor
     * @param Array data datos de un Pais
     */
    public function __construct($data)
    {
    	if(!array_key_exists('seats', $data))
            $data['seats'] = 0;
        $this->seats = (int)($data['seats']);
        
        if(!array_key_exists('rooms', $data))
            $data['rooms'] = 0;
        $this->rooms = (int)($data['rooms']);

        if(!array_key_exists('last_update', $data))
            $data['last_update'] = "";
        $this->last_update = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($data['last_update'])));
    }

}