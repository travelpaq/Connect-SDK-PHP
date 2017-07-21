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
 * Class PackageSummary
 * 
 * Clase que contiene un listado de destinos
 *
 * @package TravelPAQ
 */
class PackageSummary
{
	/*
	* Fecha de salida
	*/
	public $departure_date;

	/*
	* Precio final del paquete
	*/
	public $final_price;

	/*
	* Noches de estadía que incluye el paquete
	*/
	public $total_nights;

	/*
	* Destino del paquete
	*/
	public $DestinationPlace;	

	/*
	* Hotel del paquete
	*/
	public $Hotel;	
    
    /**
     * Constructor
     * @param Array Representa el resultado de destino
     */
    public function __construct($data)
    {	

    	$this->departure_date = '';
    	if(array_key_exists('departure_date', $data) && $data['departure_date'])
			$this->departure_date = $data['departure_date'];

		$this->final_price = 0;
    	if(array_key_exists('final_price', $data) && $data['final_price'])
			$this->final_price = (float)($data['final_price']);

		$this->total_nights = 0;
    	if(array_key_exists('total_nights', $data) && $data['total_nights'])
			$this->total_nights = (int)($data['total_nights']);

		
		$this->DestinationPlace = [];
		if(array_key_exists('DestinationPlace', $data) && $data['DestinationPlace']){
			if(array_key_exists('iata', $data['DestinationPlace']) && $data['DestinationPlace']['iata']){
				if(strlen($data['DestinationPlace']['iata']) == 2){
					$this->DestinationPlace = new Country($data['DestinationPlace']);
				} else {
					if(strlen($data['DestinationPlace']['iata']) == 3){
						$this->DestinationPlace = new Place($data['DestinationPlace']);
					} else {
						if(strlen($data['DestinationPlace']['iata']) == 4){
							$this->DestinationPlace = new Region($data['DestinationPlace']);
						}	
					}	
				}
			}
		}

		$this->Hotel = [];
		if(array_key_exists('Hotel', $data) && $data['Hotel']){
			$this->Hotel = new Hotel($data['Hotel']);
		}
    }
}