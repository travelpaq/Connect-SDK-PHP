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
 * Class FarePackage
 * 
 * Clase que contiene datos de una tarifa con sus niños.
 *
 * @package TravelPAQ
 */
class FarePackage
{
	/*
	* @var int Cantidad de adultos que soporta la tarifa.
	*/
	public $adult;
	/*
	* @var ChildFare tarifas de niños que soporta la tarifa.
	*/
	public $ChildrenFare;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct($data)
    {
    	if(!array_key_exists('adult', $data) && $data['adult'] > 0)
            $data['adult'] = 0;
        $this->adult = (int)($data['adult']);
        
        if(array_key_exists('ChildrenFare', $data) && count($data['ChildrenFare']) > 0){
        	foreach($data['ChildrenFare'] as $ChildFare){
        		$this->ChildrenFare[] = new ChildFare($ChildFare);
        	}
        } else {
        	$this->ChildrenFare = [];
        }
    }

}