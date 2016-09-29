<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   Facundo J Gonzalez <facujgg@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

/**
 * Class BookingStatus
 * 
 * Clase que contiene la información del estado de una reserva.
 *
 * @package TravelPAQ
 */
class BookingStatus
{
	/*
	* @var integer Identificador de la reserva.
	*/
	public $booking_id;
	/*
	* @var Fare Tarifas de la reserva
	*/
	public $Fare;

	/*
	* @var Passenger Listado de los pasajeros
	*/
	public $Passenger;
	/*
	* @var Package Datos del paquete
	*/
	public $Package;
	/*
	* @var string Estado del paquete (WAITING, EXPIRED, CANCELING, CANCELED,
	* CONFIRMING, CONFIRMED, ACTIVE, ERROR)
	*/
	public $status;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	   
        if(array_key_exists('status', $data) && $data['Package']){
    		$this->Package = new Package($data['Package']);
        } else {
            $this->Package = null;
        }

    	$this->Fare = [];
    	foreach ($data['Fare'] as $key => $fare) {
    		$this->Fare[] = new Fare($fare);
    	}
    	

    	$this->Passenger = [];
    	foreach ($data['Passenger'] as $key => $passenger) {
    		$this->Passenger[] = new Passenger($passenger);
    	}

    	if(!array_key_exists('status', $data))
            $data['status'] = "";
        $this->status = $data['status'];

    	if(!array_key_exists('booking_id', $data))
            $data['booking_id'] = "";
        $this->booking_id = $data['booking_id'];
    }

}