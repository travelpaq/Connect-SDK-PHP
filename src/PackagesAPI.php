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

use TravelPAQ\PackagesAPI\Validator\BookData;
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
     * - 'key' clave privada de la empresa de turismo para acceder al servicio
     *         otorgada por TravelPAQ.
     * - 'item_per_page' cantidad de items por pagina para pedir paquetes.
     *
     * @param mixed $config 
     */
    public function __construct($config) 
    {
        HttpClient::getInstance([
            'url' => 'https://api.travelpaq.com.ar',
            'key' => $config['api_key'],
            'item_per_page' => $config['item_per_page']
        ]);
    }

    /**
     * Obtiene un listado de paquetes en base a un conjunto de parámetros
     * que filtrán la búsqueda
     * 
     * Array que reprsenta los parametros de bísqueda
     * 
     * @param mixed $filters 
     * 
     * Número de página que retornara el método
     * 
     * @param int $page 
     * 
     * Representa una página de resultado de búsqueda.
     * 
     * @return PackagesPagination
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
     * Obtiene un paquete en dado un identificador
     * 
     * Identificador del paquete que se desea obtener
     * 
     * @param int $package_id 
     *
     * Retorna un objeto Package, el cual representa paquete con sus datos 
     * 
     * @return Package
     */
    public function getPackage($package_id)
    {
        if(!is_numeric($package_id) && $package_id > 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $ps = new PackageService();
        return $ps->getPackage($package_id);
    }
    
    /**
     * Verifica disponibilidad de un paquete
     *
     * Identificador del paquete del cual se desea verificar la disponibilidad
     *
     * @param int $package_id 
     *
     * Retorna el estado del paquete junto con los datos del paquete.
     * El objeto PackageStatus contienen el estado de disponibilidad
     * y los datos del paquete en cuestion
     *
     * - AVAILABLE: status de un paquete disponible
     * - NOT_AVAILABLE: status de un paquete no disponible
     *
     * @return PackageStatus packageStatus
     */
    public function checkAvail($package_id)  
    {
        if(!is_numeric($package_id) && $package_id > 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor que cero');

        $bookingService = new BookingPackageService();
        return $bookingService->checkAvail($package_id);
    }
    
    /**
     * Realiza el booking un paquete basandose en el parametro $booking, el cual tiene 
     * toda la información necesaria para realizarlo.
     *
     * Datos necesarios para la reserva de un paquete. Incluye tarifa, id del paquete 
     * y los  pasajeros del paquete.
     * 
     * @param mixed $book_data
     * 
     * Retorna una instancia de BookingStatus, el cual tiene el estado de la reserva 
     * más todos los datos de la misma. Los estados:
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
     * @return BookingStatus bookingStatus
     *
     */
    public function bookingPackage($book_data)
    {
        $book_data = new BookData($book_data);
        if(!$book_data->validate())
            throw new ValidationException($book_data->get_last_error());
        $bookingService = new BookingPackageService();
        return $bookingService->bookingPackage($book_data);
    }
    

    /**
     * Obtiene el estado actual de una reserva, retornando los mismos datos que el bookingPackage, solo que este método es de lectura bookingPackage()
     *
     * Identificador de la reserva
     *
     * @param int $booking_id
     *
     * Retorno del estado de la reserva identificada con el id $booking_id. 
     * Los estados posibles son los mismos que para el 
     *
     * @return BookingStatus Retorna la reserva de un paquete
     */
    public function getBookingPackage($booking_id)
    {
        if(!is_numeric($booking_id) && $booking_id > 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor a cero');

        $bookingService = new BookingPackageService();
        return $bookingService->getBookingPackage($booking_id);
    }

}