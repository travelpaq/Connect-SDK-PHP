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
 * Class PackageStatus
 * 
 * Clase que contiene la información del estado de un paquete y sus datos
 *
 * @package TravelPAQ
 */
class PackageStatus
{
	/*
	* @var Package Datos del paquete
	*/
	public $Package;
	/*
	* @var string Estado del paquete (AVAILABLE, NOT_AVAILABLE)
	*/
	public $status;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	$this->Package = new Package($data['Package']);
    	if(!array_key_exists('status', $data))
            $data['status'] = "";
        $this->status = $data['status'];
    }

}