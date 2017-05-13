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
    * @var string Tipo de moneda de la reserva
    */
    public $currency;
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
    * @var string Teléfono de contacto para la reserva.
    */
    public $contact_phone;

    /*
    * @var number Comisión de la agencia configurada al momento de realizarse la reserva
    */

    public $agency_commision;

    /*
    * @var number Tipo de cambio configurado al momento de realizarse la reserva
    */

    public $type_change;

    /*
    * @var number Markup configurado al momento de realizarse la reserva.
    */

    public $markup;

    /*
    * @var Fare Tarifas de la reserva
    */
    public $Fare;

    /*
    * @var Passenger Listado de los pasajeros
    */
    public $Room;
    /*
    * @var Package Datos del paquete
    */
    public $Package;

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

        if(!array_key_exists('currency', $data)){
            if($this->Package and $this->Package->Price && $this->Package->Price->currency){
                $data['currency'] = $this->Package->Price->currency;
            } else {
                $data['currency'] = 'ARS';
            }
        }
        $this->currency = $data['currency'];


        $this->Fare = [];
        foreach ($data['Fare'] as $key => $fare) {
            $this->Fare[] = new Fare($fare);
        }
        
        if(array_key_exists('Room', $data))   
            foreach ($data['Room'] as $i => $room){
                
                $this->Room[] = [];
                foreach ($room as $passenger)
                    $this->Room[$i][] = new Passenger($passenger);  
            }
        else 
            throw new ValidationException("No se han los pasajeros que viajarán con el paquete sobre el cual se desea realizar la reserva");
        

        if(!(array_key_exists('Pricing', $data) && $data['Pricing'] && count($data['Pricing']))){
            $data['Pricing'] = null;
        } else {
            $this->Pricing = new Pricing($data['Pricing']);
        }

        if(array_key_exists('message_error', $data) && $data['message_error']){
            $this->message_error = $data['message_error'];
        } else {
            $this->message_error = "";
        }

        if(array_key_exists('contact_phone', $data) && $data['contact_phone']){
            $this->contact_phone = $data['contact_phone'];
        } else {
            $this->contact_phone = "";
        }

        if(!array_key_exists('booking_id', $data))
            $data['booking_id'] = "";
        $this->booking_id = $data['booking_id'];

        if(!array_key_exists('external_id', $data))
            $data['external_id'] = "";
        $this->external_id = $data['external_id'];

        if(!array_key_exists('agency_comission', $data))
            $data['agency_comission'] = "";
        $this->agency_comission = $data['agency_comission'];

        if(!array_key_exists('type_change', $data))
            $data['type_change'] = "";
        $this->type_change = $data['type_change'];

        if(!array_key_exists('markup', $data))
            $data['markup'] = "";
        $this->markup = $data['markup'];
    }

}