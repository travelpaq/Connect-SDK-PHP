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

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;

/**
 * Class Passport
 * 
 * Clase que contiene datos del pasaporte
 *
 * @package TravelPAQ
 */
class Passport
{
	/*
	* @var int Fecha de vencimiento de pasaporte.
	*/
	public $expired_date;
    
    /**
     * Constructor
     * @param data Datos del pasaporte
     */
    public function __construct($data)
    {

        if(!array_key_exists('expired_date', $data))  
            throw new ValidationException("Falta la fecha de expiración."); 
        else
            $this->expired_date = $data['expired_date'];
    }

}