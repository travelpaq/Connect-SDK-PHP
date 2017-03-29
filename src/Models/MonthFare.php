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
 * Class MonthFare
 * 
 * Clase que contiene datos de las tarifas disponibles en un mes en particular.
 *
 * @package TravelPAQ
 */
class MonthFare
{
    /*
    * @var Month que contiene las tarifas en cuestión.
    */
    public $Month;
    /*
    * @var PackageFares Tarifas contenidas en el mes en cuestión.
    */
    public $PackageFares;

    /*
    * @var haveChildrenFare Bandera que muestra si el producto tiene tarifas children.
    */
    public $haveChildrenFare;

    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
        if(array_key_exists('Month', $data) && $data['Month'])
            $this->Month = new Month($data['Month']);
        else $this->Month = [];

        if(array_key_exists('PackageFares', $data) && count($data['PackageFares']) > 0){
            $this->PackageFares = [];
            foreach($data['PackageFares'] as $PackageFare){
                $this->PackageFares[] = new PackageFare($PackageFare);
            }
        } else {
            $this->PackageFares = [];
        }

        if(array_key_exists('haveChildrenFare', $data) && $data['haveChildrenFare'])
            $this->haveChildrenFare = $data['haveChildrenFare'];
        else $this->haveChildrenFare = false;
    }
}