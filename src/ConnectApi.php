<?php

namespace TravelPAQ\PackagesAPI;

public class PackagesAPI
{
    var $api_key;
    /**
     * Crea una nueva instancia de PackagesAPI
     */
    public function __construct($api_key) 
    {
        $this->api_key = $api_key;
        $this->http_client = HttpClient::getInstance([
                                                       'url' => 'http://api.travelpaq.com.ar/v1/',
                                                       'token' => $token
                                                    ]);
    }

    /**
     * Obtiene el listado de los paquetes
     *
     * @param $filters Criterio de busqueda de paquetes 
     * 
     * @return Array Listado de paquetes
     */
    public function getPackageList($filters)
    {
        return Package::all($filters);
    }

    /**
     * Obtiene un paquete en particular
     *
     * @param string $id 
     *
     * @return Package Retorna un paquete con sus datos 
     */
    public function getPackage($id){
        return Package::find($id);
    }
    
    /**
     * Verifica disponibilidad
     *
     * @param mixed $selection 
     *
     * @return PackageStatus Retorna si un paquete esta disponible
     */
    public function checkAvail($selection){
        return BookingPackage::checkAvail($selection);
    }
    
    /**
     * Hace la reserva de un paquete
     *
     * @param mixed $booking Datos de los pasajeros para el 
     * 
     * @return string Retorna la reserva
     *
     */
    public function bookingPackage($booking){
        $bookingPackage = BookingPackage::create($booking);
        return $bookingPackage;
    }
    
    /**
     * Obtiene el detalle de la reserva de un paquete
     *
     * @param string $id Identificador de la reserva
     *
     * @return BookingPackage Retorna la reserva de un paquete
     */
    public function getBookingPackage($id){
        return BookingPackage::find($id);;
    }

}
