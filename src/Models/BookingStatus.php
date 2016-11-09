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
use TravelPAQ\PackagesAPI\Models\Exceptions\Pricing;

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
    * @var string Identificador de la reserva que retorna el Operador.
    */
    public $external_id;
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
    * CONFIRMING, CONFIRMED, ERROR)
    */
    public $status;

    /*
    * @var string Si hay un error, se muestra en este campo.
    */
    public $message_error;

    /*
    * @var Pricing Muestra la liquidación con todos los datos que nevia el operador.
    */
    public $Pricing;

    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
           
        if(!array_key_exists('status', $data))
            $data['status'] = "";
        $this->status = $data['status'];
        
        if($this->status != 'ERROR' && array_key_exists('Package', $data) && $data['Package']){
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

        if(!(array_key_exists('Pricing', $data) && $data['Pricing'])){
            $data['Pricing'] = null;
        }
        $this->Pricing = new Pricing($data['Pricing']);


        if(array_key_exists('message_error', $data) && $data['message_error']){
            $this->message_error = $data['message_error'];
        } else {
            $this->message_error = "";
        }

        if(!array_key_exists('booking_id', $data))
            $data['booking_id'] = "";
        $this->booking_id = $data['booking_id'];

        if(!array_key_exists('external_id', $data))
            $data['external_id'] = "";
        $this->external_id = $data['external_id'];
    }

}