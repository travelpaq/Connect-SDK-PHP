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
 * Class PackagesList
 * 
 * Clase que contiene un listado de paquetes
 *
 * @package TravelPAQ
 */
class PackagesList
{
	/*
	* @var Array Listado de paquetes
	*/
	var $items;
    /**
     * Constructor
     * @param Array Listado de paquetes
     */
    public function __construct($packages) 
    {
    	$this->schema = file_get_contents(__DIR__.'/../json/schemas/output/getPackageList.schema.json');
    	$items = [];
    	foreach ($packages as $key => $package) {
    		$items[] = new Package($package);
    	}
    }

}