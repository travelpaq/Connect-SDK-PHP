<?php
/**
 * TravelPAQ Connect Api - Api para la búsqueda y reserva 
 * de paquetes turísticos de Tour Operadores
 *
 * @package  TravelPAQ
 * 
 * @author   Maximiliano Alves Pinheiro <malves@travelpaq.com.ar>
 * @author   TravelPAQ <malves@travelpaq.com.ar>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI;

use TravelPAQ\PackagesAPI\Models\BookData;
use TravelPAQ\PackagesAPI\Models\SearchData;
use TravelPAQ\PackagesAPI\Models\FilterData;

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
                'url' => 'http://travelpaq-connect-test.us-east-1.elasticbeanstalk.com/' . $config['version'] . '/',
                'key' => $config['api_key'],
                'item_per_page' => $config['item_per_page']
            ]);
        }else{
            HttpClient::getInstance([
                'url' => 'https://api.travelpaq.com.ar/'.$config['version'] .'/',
                'key' => $config['api_key'],
                'item_per_page' => $config['item_per_page']
            ]);
        }
    }

    /**
     * Obtiene un listado de paquetes en base a un conjunto de parámetros
     * que filtrán la búsqueda
     * 
     * @param Array $params Representa los parametros de búsqueda
     * 
     * @param int $page Número de página
     *
     * @param Array $filters Representa los filtros para hacer más precisa la búsqeuda
     * 
     * @return PackagesPagination Representa una página de resultado de búsqueda.
     */
    public function getPackageList($params,$page = 0, $filters = null)
    {
        $sd = new SearchData($params);
        if(!$sd->validate()){
            throw new ValidationException($sd->get_last_error());
        }
        $ps = new PackageService();
        if($filters){
            $fi = new FilterData($filters);
            if(!$fi->validate()){
                throw new ValidationException($fi->get_last_error());
            }
            return $ps->getPackageList($params,$page,$filters);
        }
        return $ps->getPackageList($params,$page); 
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
        if(!json_decode(base64_decode($package_id)))
            throw new ValidationException('El identificador no es correcto');
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
         if(!json_decode(base64_decode($package_id)))
            throw new ValidationException('El identificador no es correcto');

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
     * Obtiene todas los categorias a las cuales pueden pertenecer los paquetes
     *     
     *
     * @return Array Category Retorna un array con todas las categorias a las cuales puede pertenecer un paquete
     *
     */
    public function getCategories()  
    {
        $travelService = new TravelService();
        return $travelService->getCategories();
    }

    /**
     * Obtiene todos los tipos de servicios los cuales puede incluir un paquete
     *     
     *
     * @return Array ServiceKind Retorna un array con todos los tipos de servicio que puede incluir un paquete
     *
     */
    public function getServiceKinds()  
    {
        $travelService = new TravelService();
        return $travelService->getServiceKinds();
    }



    /**
     * Obtiene todos los destinos donde hay paquetes disponibles
     *
     * @param string|null $country_iata IATA del pais del cual se requieren los lugares
     *
     * @return Destinies Retorna un listado de lugares del pais solicitado, o todos los
     * destinos disponibles si el $country_iata no fue especificado o esta en null 
     *
     */
    public function getPlacesWithPackage($country_iata = null)  
    {
        $travelService = new TravelService();
        return $travelService->getPlacesWithPackage($country_iata);
    }

    /**
     * Obtiene todas los meses de salida para un IATA en particular
     *
     * @param string $place_iata IATA del lugar del cual se requieren los meses de salida
     *
     * @return Months Retorna un listado de meses en los que salen los paquetes de un 
     * destino determinado
     *
     */
    public function getMonthByPlaces($place_iata = null)  
    {
        $travelService = new TravelService();
        return $travelService->getMonthByPlaces($place_iata);
    }

    /**
     * Obtiene todas las tarifas para un IATA determinado y mes / año específico
     *
     * @param string $origin_place IATA del lugar de salida de los paquetes de los cuales se requieren las tarifas
     *
     * @param string $departure_place IATA del lugar de llegada de los paquetes de los cuales se requieren las tarifas
     *
     * @param int $month Mes del que se quieren averiguar las tarifas disponibles
     *
     * @param year $year Año del que se quieren averiguar las tarifas disponibles
     *
     * @return FaresPackage Retorna un listado de tarifas de paquetes
     *
     */
    public function getFaresPackage($origin_place = null, $departure_place = null, $month = null, $year = null)  
    {
        $travelService = new TravelService();
        return $travelService->getFaresPackage($origin_place, $departure_place, $month, $year);
    }

     /**
     * Obtiene todas las tarifas 
     *
     * @return Array PackageFares Retorna un listado de tarifas de paquetes
     *
     */
    public function getFaresTree()  
    {
        $travelService = new TravelService();
        return $travelService->getFaresTree();
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
    public function getBooking($booking_id, $html = false)
    {
        if(!is_numeric($booking_id) || $booking_id <= 0)
            throw new ValidationException('El identificador que debe recibir este método debe ser un número entero mayor a cero');

        $bookingService = new BookingPackageService();
        return $bookingService->getBooking($booking_id, $html);
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

    /**
     * Agrega un paquete al listado ya cargado por el operador que esta invocando al método
     *
     * @param Array $package Representa el paquete a cargar
     *
     * @return Package Retorna un objeto de tipo Package
     */
    public function addPackage($package)
    {
        if(!$package)
            throw new ValidationException('El paquete enviado debe ser distinto de vacío');

        $packageService = new PackageService();
        return $packageService->addPackage($package);
    }

    /**
     * Modifica un paquete del listado ya cargado por el operador que esta invocando al método
     *
     * @param Array $package Representa el paquete a modificar con las modificaciones cargadas
     *
     * @return Package Retorna un objeto de tipo Package
     */
    public function editPackage($package)
    {
        if(!$package)
            throw new ValidationException('El paquete enviado debe ser distinto de vacío');

        $packageService = new PackageService();
        return $packageService->editPackage($package);
    }

    /**
     * Retorna un paquete del listado ya cargado por el operador que esta invocando al método
     *
     * @param string $package_id Identificador del paquete y todas sus tarifas
     *
     * @return Package Retorna un objeto de tipo Package
     */
    public function viewPackage($package_id)
    {
        if(!$package_id)
            throw new ValidationException('No se ha recibido el identificador del paquete.');

        $packageService = new PackageService();
        return $packageService->viewPackage($package_id);
    }

    /**
     * Retorna un listado de paquetes  ya cargadados por el operador que esta invocando al método
     *
     * @return Array Retorna un array de Package
     */
    public function indexPackage()
    {
        $packageService = new PackageService();
        return $packageService->indexPackage();
    }

    /**
     * Elimina un paquete del listado ya cargadados por el operador que esta invocando al método
     *
     * @return Package Retorna el objeto de tipo Package eliminado
     */
    public function deletePackage($package_id)
    {
        $packageService = new PackageService();
        return $packageService->deletePackage();
    }

}