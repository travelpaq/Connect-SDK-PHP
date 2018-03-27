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

/**
 * Class PackagesPagination
 * 
 * Clase que contiene la información de la paginación y 
 * los resultados de la búsqueda de un listado de paquetes
 *
 * @package TravelPAQ
 */
class PackagesPagination
{
	/*
	* @var PackageList listado de paquetes
	*/
	public $result;
	/*
	* Página actual
	*/
	public $current_page;
	/*
	* Total de páginas
	*/
	public $total_page;
	/*
	* Items por página
	*/
	public $item_per_page;

	/*
	* Total de items
	*/
	public $total_items;

	/*
	* Existe pagina anterior
	*/
	public $has_prev_page;

	/*
	* Existe pagina siguiente
	*/
	public $has_next_page;

	/*
	* Precio mínimo para esa búsqueda
	*/
	public $min_price;

	/*
	* Precio máximo para esa búsqueda
	*/
	public $max_price;

	/*
	* Cantidad mínima de noches para esa búsqueda
	*/
	public $min_nights;

	/*
	* Cantidad máxima de noches para esa búsqueda
	*/
	public $max_nights;

	/*
	* Cantidad mínima de estrellas de hotel para esa búsqueda
	*/
	public $min_star;

	/*
	* Cantidad máxima de estrellas de hotel para esa búsqueda
	*/
	public $max_star;

	/*
	* Cantidad mínima de fechas de salida para esa búsqueda
	*/
	public $min_date_departure;

	/*
	* Cantidad máxima de fechas de salida para esa búsqueda
	*/
	public $max_date_departure;

	/*
	* Cantidad de estrellas para esa búsqueda
	*/
	public $hotel_star_ratings;

	/*
	* Nombre de hoteles para esa búsqueda
	*/
	public $hotel_names;

	/*
	* Tipo de cuartos para esa búsqueda
	*/
	public $hotel_room_kinds;

	/*
	* Regimes de hoteles para esa búsqueda
	*/
	public $hotel_regimes;

	/*
	* Operadores a los que pertenecen los paquetes resultantes de la búsqueda.
	*/
	public $Company;
    
    /**
     * Constructor
     * @param Array Listado de paquetes desde la API
     */
    public function __construct($packagesList)
    {	
    	$this->result = [];
    	foreach ($packagesList['data'] as $key => $package) {
    		$this->result[] = new Package($package);
    	}
    	$this->current_page = (int)$packagesList['pagination']['page_index'];
    	$this->total_page = (int)$packagesList['pagination']['count_pages'];
    	$this->item_per_page = (int)$packagesList['pagination']['page_size'];
    	$this->total_items = (int)$packagesList['pagination']['count_items'];    	
    	$this->has_next_page = (int)$packagesList['pagination']['has_next_page'];
    	$this->has_prev_page = (int)$packagesList['pagination']['has_prev_page'];

    	
    	$this->min_price = (int)round($packagesList['filters_data']['min_price']);

    	if($this->min_price < 0 || $this->min_price > 10000000)
    		$this->min_price = 0;
    	$this->max_price = (int)round($packagesList['filters_data']['max_price']);
	
	   	$this->min_nights = (int)$packagesList['filters_data']['min_nights'];
    	if($this->min_nights < 0 || $this->min_nights > 10000000)
    		$this->min_nights = 0;
    	$this->max_nights = (int)$packagesList['filters_data']['max_nights'];

    	if(count($packagesList['filters_data']['hotel_star_ratings']) > 0){
	    	$this->min_star = (int)$packagesList['filters_data']['hotel_star_ratings'][0];
	    	
	    	$this->max_star = (int)$packagesList['filters_data']['hotel_star_ratings'][count($packagesList['filters_data']['hotel_star_ratings'])-1];
    	}

    	$this->min_date_departure = $packagesList['filters_data']['min_departure_date'];
    	$this->max_date_departure = $packagesList['filters_data']['max_departure_date'];

    	if(!array_key_exists('companies', $packagesList['filters_data']) || !$packagesList['filters_data']['companies']){
    		$packagesList['Company'] = [];
    	}
    	$this->Company = $packagesList['filters_data']['companies'];

    	$hotel_regimes = [];
    	if(array_key_exists('hotel_regimes', $packagesList['filters_data'])){
    		$this->hotel_regimes = $packagesList['filters_data']['hotel_regimes'];	
    	}

    	$hotel_room_kinds = [];
    	if(array_key_exists('hotel_room_kinds', $packagesList['filters_data'])){
    		$this->hotel_room_kinds = $packagesList['filters_data']['hotel_room_kinds'];
    	}

    	$hotel_names = [];
    	if(array_key_exists('hotel_names', $packagesList['filters_data'])){
    		$this->hotel_names = $packagesList['filters_data']['hotel_names'];	
    	}

    	$hotel_star_ratings = [];
    	if(array_key_exists('hotel_star_ratings', $packagesList['filters_data'])){
    		$this->hotel_star_ratings = $packagesList['filters_data']['hotel_star_ratings'];	
    	}


    }

}