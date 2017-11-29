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
 * Class DestinyResult
 * 
 * Clase que contiene un listado de destinos
 *
 * @package TravelPAQ
 */
class DestinyResult
{
	/*
	* Tipo de desino
	*/
	public $type;

	/*
	* Campo principal de agrupamiento 
	*/
	public $main_group_by;

	/*
	* Campo secundario de agrupamiento 
	*/
	public $secondary_group_by;

	/*
	* Destino
	*/
	public $Destiny;

	/*
	* Paquete mínimo o maximo de precio o fecha de salida según parámetros
	*/
	public $Package;

	/*
	* Representacion resumida de un paquete
	*/
	public $PackagesSummary;	
    
    /**
     * Constructor
     * @param Array Representa el resultado de destino
     */
    public function __construct($data)
    {	
    	$this->type = '';
    	if(array_key_exists('type', $data) && $data['type'])
			$this->type = $data['type'];


		$this->main_group_by = 'REGION';
    	if(array_key_exists('main_group_by', $data) && $data['main_group_by'])
			$this->main_group_by = $data['main_group_by'];

		$this->secondary_group_by = 'COUNTRY';
    	if(array_key_exists('secondary_group_by', $data) && $data['secondary_group_by'])
			$this->secondary_group_by = $data['secondary_group_by'];

		
		$this->Destiny = [];
		if(array_key_exists('Destiny', $data) && $data['Destiny']){
			if($this->type == 'PLACE'){
			}
			else {
				if($this->type == 'COUNTRY'){
					$this->Destiny = new Place($data['Destiny']);
				}
				else {
					if($this->type == 'REGION'){
						$this->Destiny = new Country($data['Destiny']);
					} else {
						if($this->type == 'ALL'){
							$this->Destiny = new Region($data['Destiny']);
						}
					}
				}
			}
		}

		
		$this->Package = [];
		if(array_key_exists('Package', $data) && $data['Package'])
			$this->Package = new Package($data['Package']);

		$this->PackagesSummary = [];
		if(array_key_exists('PackagesSummary', $data) && $data['PackagesSummary']){
			foreach($data['PackagesSummary'] as $packageSummary){
				$this->PackagesSummary[] = new PackageSummary($packageSummary);
			}
		}
    }
}