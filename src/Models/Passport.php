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
namespace TravelPAQ\PackagesAPI\Models;

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
	* @var string Número de pasaporte.
	*/
	public $number;
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
    	
        if(!array_key_exists('number', $data))    
            throw new ValidationException("Falta el número de pasaporte del pasajero."); 
        else
            $this->number = $data['number'];

        if(!array_key_exists('expired_date', $data))  
            throw new ValidationException("Falta la fecha de expiración."); 
        else
            $this->expired_date = $data['expired_date'];
    }

}