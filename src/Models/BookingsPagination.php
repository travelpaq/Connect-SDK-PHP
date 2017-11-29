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

/**
 * Class BookingsPagination
 * 
 * Clase que contiene la información de la paginación y 
 * los resultados de las reservas de una agencia
 *
 * @package TravelPAQ
 */
class BookingsPagination
{
	/*
	* @var BookingsList listado de paquetes
	*/
	public $result;
	/*
	* Página actual
	*/
	public $current_page;
	/*
	* Total de páginas
	*/
	public $total_page;
	/*
	* Items por página
	*/
	public $item_per_page;

	/*
	* Total de items
	*/
	public $total_items;

    /**
     * Constructor
     * @param Array Listado de paquetes desde la API
     */
    public function __construct($bookingsList)
    {
    	$this->result = [];
    	foreach ($bookingsList['result'] as $key => $booking) {
    		if(array_key_exists('percentage_tp_ota', $booking) && array_key_exists('percentage_tp_operator', $booking) && $booking['percentage_tp_ota'] !== null && $booking['percentage_tp_operator'] !== null){
    			$this->result[] = new BookingStatusTravelPAQ($booking);
    		} else {
    			$this->result[] = new BookingStatus($booking);
    		}
    	}
    	$this->current_page = (int)$bookingsList['current_page'];
    	$this->total_page = (int)$bookingsList['total_page'];
    	$this->item_per_page = (int)$bookingsList['item_per_page'];
    	$this->total_items = (int)$bookingsList['total_items'];
    }

}