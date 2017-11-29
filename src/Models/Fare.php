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
 * Class Fare
 * 
 * Clase que contiene datos de una tarifa.
 *
 * @package TravelPAQ
 */
class Fare
{
	/*
	* @var string Tipo de tarifa.
	*/
	public $type;
	/*
	* @var int Cantadad solicitada.
	*/
	public $quantity;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	if(!array_key_exists('type', $data))
            $data['type'] = "";
        $this->type = $data['type'];
        if(!array_key_exists('quantity', $data))
            $data['quantity'] = "";
        $this->quantity = $data['quantity'];
    }

}