<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   Facundo J Gonzalez <facujgg@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Core;

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
	var $packagesList;
	/*
	* Página actual
	*/
	var $current_page;
	/*
	* Total de páginas
	*/
	var $total_page;
	/*
	* Items por página
	*/
	var $item_per_page;
    /**
     * Constructor
     * @param Array Listado de paquetes desde la API
     */
    public function __construct($packagesList)
    {
    	$this->packagesList = new PackagesList($packagesList['result']);
    	$this->current_page = $packagesList['current_page'];
    	$this->total_page = $packagesList['total_page'];
    	$this->item_per_page = $packagesList['item_per_page'];
    }

}