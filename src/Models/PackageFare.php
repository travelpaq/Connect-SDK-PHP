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
 * Class PackageFare
 * 
 * Clase que contiene datos de una tarifa con sus niños.
 *
 * @package TravelPAQ
 */
class PackageFare
{
	/*
	* @var int Cantidad de adultos que soporta la tarifa.
	*/
	public $adult;
    /*
    * @var max_number_children Máxima cantidad de niños que pueden compatibilizarse con una tarifa adulto.
    */
    public $max_number_children;

    /*
    * @var min_age Edad mínima de niños que pueden compatibilizarse con esta tarifa adulto.
    */
    public $min_age;

    /*
    * @var max_age Edad máxima de niños que pueden compatibilizarse con esta tarifa adulto.
    */
    public $max_age;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	if(!array_key_exists('adult', $data) && $data['adult'] > 0)
            $data['adult'] = 0;
        $this->adult = (int)($data['adult']);
        
        if(!array_key_exists('max_number_children', $data) && $data['max_number_children'] > 0)
            $data['max_number_children'] = 0;
        $this->max_number_children = (int)($data['max_number_children']);

        if(!array_key_exists('min_age', $data) && $data['min_age'] > 0)
            $data['min_age'] = 0;
        $this->min_age = (int)($data['min_age']);

        if(!array_key_exists('max_age', $data) && $data['max_age'] > 0)
            $data['max_age'] = 0;
        $this->max_age = (int)($data['max_age']);
    }

}