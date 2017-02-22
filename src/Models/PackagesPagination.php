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
    
    /**
     * Constructor
     * @param Array Listado de paquetes desde la API
     */
    public function __construct($packagesList)
    {
    	$this->result = [];
    	foreach ($packagesList['result'] as $key => $package) {
    		$this->result[] = new Package($package);
    	}
    	$this->current_page = (int)$packagesList['current_page'];
    	$this->total_page = (int)$packagesList['total_page'];
    	$this->item_per_page = (int)$packagesList['item_per_page'];
    	$this->total_items = (int)$packagesList['total_items'];
    	
    	$this->min_price = (int)round($packagesList['min_price']);
    	if($this->min_price < 0 || $this->min_price > 10000000)
    		$this->min_price = 0;
    	$this->max_price = (int)round($packagesList['max_price']);
	
	   	$this->min_nights = (int)$packagesList['min_nights'];
    	if($this->min_nights < 0 || $this->min_nights > 10000000)
    		$this->min_nights = 0;
    	$this->max_nights = (int)$packagesList['max_nights'];

    	$this->min_star = (int)$packagesList['min_star'];
    	if($this->min_star < 0 || $this->min_star > 10000000)
    		$this->min_star = 0;
    	$this->max_star = (int)$packagesList['max_star'];

    	$this->min_date_departure = $packagesList['min_date_departure'];
    	$this->max_date_departure = $packagesList['max_date_departure'];
    }

}