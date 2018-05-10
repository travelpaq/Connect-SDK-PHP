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
 * Class PlaceFare
 * 
 * Clase que contiene datos de las tarifas disponibles en un destino en particular.
 *
 * @package TravelPAQ
 */
class PlaceFare
{
    /*
    * @var Place que contiene las tarifas en cuestión.
    */
    public $Place;
    /*
    * @var MonthFares Meses en los cuales este Place tiene tarifas.
    */
    public $MonthFares;

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
        $Placex = ['name'=>$data['name'],
                        'iata'=>$data['iata'],
                        'country'=>$data['country']
                        ];
        

        if($Placex['name'])
            $this->Place = new Place($Placex);
        else $this->Place = [];

        if(array_key_exists('month_fares', $data) && count($data['month_fares']) > 0){
            $this->MonthFares = [];
            foreach($data['month_fares'] as $MonthFare){
                $this->MonthFares[] = new MonthFare($MonthFare);
            }
        } else {
            $this->MonthFares = [];
        }

        if(array_key_exists('haveChildrenFare', $data) && $data['haveChildrenFare'])
            $this->haveChildrenFare = $data['haveChildrenFare'];
        else $this->haveChildrenFare = false;
    }
}