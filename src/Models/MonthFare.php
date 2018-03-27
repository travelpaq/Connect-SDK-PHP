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
        if(array_key_exists('month', $data) && $data['month'])
            $this->Month = new Month($data);
        else $this->Month = [];

        if(array_key_exists('package_fares', $data) && count($data['package_fares']) > 0){
            $data['haveChildrenFare'] = false;
            $this->PackageFares = [];
            foreach($data['package_fares'] as $PackageFare){
                $package_fares = new PackageFare($PackageFare);
                $this->PackageFares[] = $package_fares;
                if($package_fares->max_number_children > 0)
                    $data['haveChildrenFare'] = true;
            }
        } else {
            $this->PackageFares = [];
        }

        if(array_key_exists('haveChildrenFare', $data) && $data['haveChildrenFare'])
            $this->haveChildrenFare = $data['haveChildrenFare'];
        else $this->haveChildrenFare = false;

    }
}