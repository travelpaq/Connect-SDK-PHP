<?php
/**
 * TravelPAQ Connect Api - Api para la búsqueda y reserva 
 * de paquetes turísticos de Tour Operadores
 *
 * @package  TravelPAQ
 * 
 * @author   Maximiliano Alves Pinheiro <malves@travelpaq.com.ar>
 * @author   Facundo J Gonzalez <facujgg@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI;

use TravelPAQ\PackagesAPI\Validator;
use TravelPAQ\PackagesAPI\Services\HttpClient;
use TravelPAQ\PackagesAPI\Services\PackageService;
use TravelPAQ\PackagesAPI\Services\BookingPackageService;
use TravelPAQ\PackagesAPI\Validator\SearchFilter;
use TravelPAQ\PackagesAPI\Exceptions\ValidationException;
use TravelPAQ\PackagesAPI\Exceptions\JsonValidatorException;
/**
 * Class PackagesAPI
 *
 * @package TravelPAQ
 */
class PackagesAPI
{
    /**
     * Constructor.
     * 
     * @param $config 'key' clave privada para acceder al servicio otorgada por TravelPAQ y 
     * 'item_per_page' cantidad de items por pagina para pedir paquetes.
     * 
     */
    public function __construct($config) 
    {
        HttpClient::getInstance([
            'url' => 'http://travelpaq-connect-test.us-east-1.elasticbeanstalk.com/api/',
            'key' => $config['api_key'],
            'item_per_page' => $config['item_per_page']
        ]);
    }

    /**
     * Obtiene el listado de los paquetes
     *
     * @param $filters Criterio de búsqueda de paquetes 
     * @param $page Pagina a pedir
     * 
     * @return PackagesPagination Listado de paquetes paginado.
     * 
     */
    public function getPackageList($filters,$page = 0)
    {
        $sf = new SearchFilter($filters);
        if(!$sf->validate()){
            throw new ValidationException($sf->get_last_error());
        }
        $ps = new PackageService();
        return $ps->getPackageList($filters,$page);
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
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $ps = new PackageService();
        return $ps->getPackage($id);
    }
    
    /**
     * Verifica disponibilidad
     *
     * @param int $id 
     *
     * @return PackageStatus Retorna si un paquete esta disponible
     */
    public function checkAvail($id)  
    {
        if(!is_numeric($id))
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $bookingService = new BookingPackageService();
        return $bookingService->checkAvail($id);
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
            throw new ValidationException($sf->get_last_error());

        $bookingService = new BookingPackageService();
        return $bookingService->bookingPackage($booking);
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
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $bookingService = new BookingPackageService();
        return $bookingService->getBookingPackage($id);
    }

}