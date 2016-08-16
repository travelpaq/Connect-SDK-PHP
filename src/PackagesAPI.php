<?php

namespace TravelPAQ\PackagesAPI;

use TravelPAQ\PackagesAPI\Services\HttpClient;
use TravelPAQ\PackagesAPI\Services\PackageService;
use TravelPAQ\PackagesAPI\Validator\SearchFilter;

class PackagesAPI
{
    /**
     * Crea una nueva instancia de PackagesAPI
     */
    public function __construct($api_key) 
    {
        HttpClient::getInstance([
            'url' => 'https://gonzalezfj.com.ar/',
            'key' => $api_key
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
        $sf = new SearchFilter($filters);
        if(!$sf->validate())
            throw new \Exception("Parámetros no válidos");
        $ps = new PackageService();
        return $ps->all($filters);
    }

    /**
     * Obtiene un paquete en particular
     *
     * @param int $id 
     *
     * @return Package Retorna un paquete con sus datos 
     */
    public function getPackage($id){
        if(!is_numeric($id)){
            throw new \Exception("Parámetros no válidos");
        }
        $ps = new PackageService();
        return $ps->find($id);
    }
    
    /**
     * Verifica disponibilidad
     *
     * @param mixed $selection 
     *
     * @return PackageStatus Retorna si un paquete esta disponible
     */
    public function checkAvail($selection){
        if(!is_numeric($id)){
            throw new \Exception("Parámetros no válidos");
        }
        $bookingService = new BookingPackageService();
        return $bookingService->checkAvail($selection);
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
        $sf = new BookFilter($booking);
        if(!$sf->validate())
            throw new \Exception("Parámetros no válidos");
        $bookingService = new BookingPackageService();
        return $bookingService->book($booking);
    }
    
    /**
     * Obtiene el detalle de la reserva de un paquete
     *
     * @param string $id Identificador de la reserva
     *
     * @return BookingPackage Retorna la reserva de un paquete
     */
    public function getBookingPackage($id){
        if(!is_numeric($id)){
            throw new \Exception("Parámetros no válidos");
        }
        $bookingService = new BookingPackageService();
        return $bookingService->find($id);
    }

}
