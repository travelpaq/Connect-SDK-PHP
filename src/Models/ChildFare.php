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
 * Class ChildFare
 * 
 * Clase que contiene datos de una tarifa con sus niños.
 *
 * @package TravelPAQ
 */
class ChildFare
{
    /*
    * @var int Límite inferior inclusivo para la edad de los niños.
    */
    public $ageFrom;
    /*
    * @var int Límite superior inclusivo para la edad de los niños.
    */
    public $ageTo;
    /*
    * @var int Número máximo de niños que soporta la tarifa.
    */
    public $maxNumber;
    /*
    * @var int Orden para identificar tarifas que tienen un precio para un menor o otra para un segundo menor, y asi sucesivamente.
    */
    public $numberOrder;
    /*
    * @var string Tipo de tarifa children.
    */
    public $kind;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
        if(!array_key_exists('ageFrom', $data) && $data['ageFrom'] > 0)
            $data['ageFrom'] = 0;
        $this->ageFrom = (int)($data['ageFrom']);

        if(!array_key_exists('ageTo', $data) && $data['ageTo'] > 0)
            $data['ageTo'] = 0;
        $this->ageTo = (int)($data['ageTo']);

        if(!array_key_exists('maxNumber', $data) && $data['maxNumber'] > 0)
            $data['maxNumber'] = 0;
        $this->maxNumber = (int)($data['maxNumber']);

        if(!array_key_exists('numberOrder', $data) && $data['numberOrder'] > 0)
            $data['numberOrder'] = 0;
        $this->numberOrder = $data['numberOrder'];

        if(!array_key_exists('kind', $data) && $data['kind'])
            $data['kind'] = "";
        $this->kind = $data['kind'];
    }
}