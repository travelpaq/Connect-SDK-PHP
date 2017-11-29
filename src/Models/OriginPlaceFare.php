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
 * Class OriginPlaceFare
 * 
 * Clase que contiene datos de las tarifas disponibles en un destino en particular.
 *
 * @package TravelPAQ
 */
class OriginPlaceFare
{
    /*
    * @var Place que contiene el lugar de partida de un conjunto de salidas.
    */
    public $OriginPlace;
    /*
    * @var PlaceFare Contiene datos de las tarifas disponibles en un destino en particular dsaliendo de OriginPlace.
    */
    public $DestinationPlace;

    /*
    * @var haveChildrenFare Bandera que muestra si el desde este lugar de salida hay tarifas children.
    */
    public $haveChildrenFare;

    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
        if(array_key_exists('OriginPlace', $data) && $data['OriginPlace'])
            $this->OriginPlace = new Place($data['OriginPlace']);
        else $this->OriginPlace = [];

        if(array_key_exists('DestinationPlace', $data) && $data['DestinationPlace']){
            foreach ($data['DestinationPlace'] as $DestinationPlace) {
                $this->DestinationPlace[] = new PlaceFare($DestinationPlace);
            }
        }
        else $this->DestinationPlace = [];

        if(array_key_exists('haveChildrenFare', $data) && $data['haveChildrenFare'])
            $this->haveChildrenFare = $data['haveChildrenFare'];
        else $this->haveChildrenFare = false;
    }
}