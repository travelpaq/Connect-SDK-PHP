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
 * Class BookingStatusTravelPAQ
 * 
 * Clase que contiene la información del estado de una reserva con información para TravelPAQ.
 *
 * @package TravelPAQ
 */
class BookingStatusTravelPAQ extends BookingStatus
{
    /*
    * @var float percentage_tp_ota
    */
    public $percentage_tp_ota;
    /*
    * @var float percentage_tp_operator
    */
    public $percentage_tp_operator;

    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	parent::__construct($data);
        
        if(!array_key_exists('percentage_tp_ota', $data))
            $data['percentage_tp_ota'] = 0;
        $this->percentage_tp_ota = (float)$data['percentage_tp_ota'];

        if(!array_key_exists('percentage_tp_operator', $data))
            $data['percentage_tp_operator'] = 0;
        $this->percentage_tp_operator = (float)$data['percentage_tp_operator'];
    }

}