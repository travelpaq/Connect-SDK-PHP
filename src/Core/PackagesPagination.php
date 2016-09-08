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
    	$this->current_page = $packagesList['current_page'];
    	$this->total_page = $packagesList['total_page'];
    	$this->item_per_page = $packagesList['item_per_page'];
    }

}