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
    public function __construct($config) 
    {
        HttpClient::getInstance([
            'url' => 'http://search-engine.us-east-1.elasticbeanstalk.com/',
            //'url' => 'http://localhost/search-engine/',
            'key' => $config['api_key'],
            'item_per_page' => $config['item_per_page'],
        ]);
    }

    /**
     * Obtiene el listado de los paquetes
     *
     * @param $filters Criterio de busqueda de paquetes 
     * 
     * @return Array Listado de paquetes
     */
    public function getPackageList($filters,$page = 0)
    {
        try
        {
            $sf = new SearchFilter($filters);
            if(!$sf->validate())
            {
                return json_encode(array('status' => 'error', 'type_error' => 'validation_error', 'error_information' => $sf->get_last_error()));
            }
            $ps = new PackageService();
            return $ps->all($filters,$page);
        } catch(Exception $e)
        {
            return json_encode(array('status' => 'error', 'type_error' => 'exception_error', 'error_information' => json_encode($e)));
        }
    }

    /**
     * Obtiene un paquete en particular
     *
     * @param int $id 
     *
     * @return Package Retorna un paquete con sus datos 
     */
    public function getPackage($id)
    {
        if(!is_numeric($id) && $id > 0)
        {
            return json_encode(array('status' => 'error', 'type_error' => 'exception_error', 'error_information' => 'El identificador que debe recibir este método debe ser un numero entero mayor que cero'));
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
    public function checkAvail($selection)  
    {
        if(!is_numeric($id))
        {
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
    public function bookingPackage($booking)
    {
        $sf = new BookData($booking);
        if(!$sf->validate())
        {
            throw new \Exception("Parámetros no válidos");
        }
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
    public function getBookingPackage($id)
    {
        if(!is_numeric($id))
        {
            throw new \Exception("Parámetros no válidos");
        }
        $bookingService = new BookingPackageService();
        return $bookingService->find($id);
    }

}
