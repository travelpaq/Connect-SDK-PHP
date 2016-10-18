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

use TravelPAQ\PackagesAPI\Models\BookData;
use TravelPAQ\PackagesAPI\Models\SearchData;

use TravelPAQ\PackagesAPI\Services\HttpClient;
use TravelPAQ\PackagesAPI\Services\PackageService;
use TravelPAQ\PackagesAPI\Services\BookingPackageService;
use TravelPAQ\PackagesAPI\Services\TravelService;

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
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
     * - 'key' clave privada de la empresa de turismo para acceder al servicio
     *         otorgada por TravelPAQ.
     * - 'item_per_page' cantidad de items por pagina para pedir paquetes.
     *
     * @param mixed $config 
     */
    public function __construct($config) 
    {
        if(array_key_exists('test', $config) && $config['test'] == true){
            HttpClient::getInstance([
                'url' => 'http://travelpaq-connect-test.us-east-1.elasticbeanstalk.com/api/',
                'key' => $config['api_key'],
                'item_per_page' => $config['item_per_page']
            ]);
        }else{
            HttpClient::getInstance([
                'url' => 'https://api.travelpaq.com.ar/'.$config['version'],
                'key' => $config['api_key'],
                'item_per_page' => $config['item_per_page']
            ]);
        }
    }

    /**
     * Obtiene un listado de paquetes en base a un conjunto de parámetros
     * que filtrán la búsqueda
     * 
     * @param Array $filters Representa los parametros de búsqueda
     * 
     * @param int $page Número de página
     * 
     * @return PackagesPagination Representa una página de resultado de búsqueda.
     */
    public function getPackageList($filters,$page = 0)
    {
        $sf = new SearchData($filters);
        if(!$sf->validate()){
            throw new ValidationException($sf->get_last_error());
        }
        $ps = new PackageService();
        return $ps->getPackageList($filters,$page);
    }

    /**
     * Obtiene un paquete en dado un identificador
     *
     * @param int $package_id Identificador del paquete que se desea obtener
     * 
     * @return Package Representa paquete con sus datos 
     */
    public function getPackage($package_id)
    {
        if(!is_numeric($package_id) || $package_id <= 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $ps = new PackageService();
        return $ps->getPackage($package_id);
    }
    
    /**
     * Verifica disponibilidad de un paquete
     *
     * @param int $package_id Identificador del paquete del cual se desea
     *  verificar la disponibilidad
     *
     * @return PackageStatus Retorna el estado del paquete junto con los datos del paquete.
     * El objeto PackageStatus contienen el estado de disponibilidad
     * y los datos del paquete en cuestion
     *
     * - AVAILABLE: status de un paquete disponible
     * - NOT_AVAILABLE: status de un paquete no disponible
     *
     */
    public function checkAvail($package_id)  
    {
        if(!is_numeric($package_id)|| $package_id <= 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $bookingService = new BookingPackageService();
        return $bookingService->checkAvail($package_id);
    }

    /**
     * Obtiene todos los destinos
     *
     * @param string|null $country_iata IATA del pais del cual se requieren los lugares
     *
     * @return Destinies Retorna un listado de lugares del pais solicitado, o todos los
     * destinos disponibles si el $country_iata no fue especificado o esta en null 
     *
     */
    public function getPlaces($country_iata = null)  
    {
        $travelService = new TravelService();
        return $travelService->getPlaces($country_iata);
    }
    
    /**
     * Realiza el booking un paquete basandose en el parametro $booking, el cual tiene 
     * toda la información necesaria para realizarlo.
     *
     * @param mixed $params Datos necesarios para la reserva de un paquete.
     * Incluye tarifa, id del paquete y los  pasajeros del paquete.
     * 
     * @return BookingStatus Retorna una instancia de BookingStatus, el cual tiene
     *  el estado de la reserva más todos los datos de la misma. Los estados:
     *
     * - WAITING
     * - EXPIRED
     * - CANCELING
     * - CANCELED
     * - CONFIRMING
     * - CONFIRMED
     * - ACTIVE
     * - ERROR
     *
     */
    public function bookingPackage($params)
    {
        $book_data = new BookData($params);
        if(!$book_data->validate())
            throw new ValidationException($book_data->get_last_error());
        $bookingService = new BookingPackageService();
        return $bookingService->bookingPackage($params);
    }
    

    /**
     * Obtiene el estado actual de una reserva, retornando los mismos datos 
     * que el bookingPackage, solo que este método es de lectura bookingPackage()
     *
     * @param int $booking_id Identificador de la reserva
     *
     * @return BookingStatus Retorno del estado de la reserva identificada con 
     * el id $booking_id. Los estados posibles son los mismos que para el 
     *
     */
    public function getBooking($booking_id)
    {
        if(!is_numeric($booking_id) || $booking_id <= 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor a cero');

        $bookingService = new BookingPackageService();
        return $bookingService->getBooking($booking_id);
    }
    /**
     * Confirma una reserva, retornando los mismos datos que el bookingPackage
     *
     * @param int $booking_id Identificador de la reserva
     *
     * @return BookingStatus Retorna la confirmación de un paquete
     */
    public function confirmBooking($booking_id)
    {
        if(!is_numeric($booking_id) || $booking_id < 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor a cero');

        $bookingService = new BookingPackageService();
        return $bookingService->confirmBooking($booking_id);
    }
    /**
     * Cancela una reserva, retornando los mismos datos que el bookingPackage
     *
     * @param int $booking_id Identificador de la reserva
     *
     * @return BookingStatus Retorna la cancelación de un paquete
     */
    public function cancelBooking($booking_id)
    {
        if(!is_numeric($booking_id) || $booking_id < 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor a cero');

        $bookingService = new BookingPackageService();
        return $bookingService->cancelBooking($booking_id);
    }

}