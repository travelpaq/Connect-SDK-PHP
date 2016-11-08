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

use TravelPAQ\PackagesAPI\Models\Exceptions\ValidationException;
/**
 * Class Pricing
 *
 * @package TravelPAQ
 */
class Pricing
{
	/*
    * @var ItemPriceShort Servicios no comisionables.
    */
	public $NonCommissionableService
	/*
    * @var ItemPriceLarge Impuestos de turísmo.
    */
    public $TourismTaxes
    /*
    * @var ItemPriceLarge Impuestos fiscales.
    */
    public $FiscalTaxes
    /*
    * @var float Precio comisionable.
    */
    public $CommissionablePrice
    /*
    * @var float Comision de la OTA.
    */
    public $CommissionAmount
    /*
    * @var float Sobrecarga de la comsión.
    */
    public $OverrideCommissionAmount
    /*
    * @var float Total a pagar de la reserva
    */
    public $Total
    
    /**
     * Constructor
     * @param Array data datos del hospedaje
     */
    public function __construct($data)
    {
		$this->NonCommissionableService = [];
        if(!array_key_exists('NonCommissionableService', $data))  
            throw new ValidationException("No se ha especificado el hotel");
		foreach ($data['NonCommissionableService'] as $key => $value) {
			$this->NonCommissionableService[] = new ItemPriceShort($value);
		}

		$this->TourismTaxes = [];
        if(!array_key_exists('TourismTaxes', $data))  
            throw new ValidationException("No se han especificado los impuestos de turísmo");
		foreach ($data['TourismTaxes'] as $key => $value) {
			$this->TourismTaxes[] = new ItemPriceLarge($value);
		}

		$this->FiscalTaxes = [];
        if(!array_key_exists('FiscalTaxes', $data))  
            throw new ValidationException("No se han especificado los impuestos fiscales");
		foreach ($data['FiscalTaxes'] as $key => $value) {
			$this->FiscalTaxes[] = new ItemPriceLarge($value);
		}

		if(!(array_key_exists('CommissionablePrice', $data) && $data['CommissionablePrice'])){
            $data['CommissionablePrice'] = 0;
        }
        $this->CommissionablePrice = $data['CommissionablePrice'];

        if(!(array_key_exists('CommissionAmount', $data) && $data['CommissionAmount'])){
            $data['CommissionAmount'] = 0;
        }
        $this->CommissionAmount = $data['CommissionAmount'];

        if(!(array_key_exists('OverrideCommissionAmount', $data) && $data['OverrideCommissionAmount'])){
            $data['OverrideCommissionAmount'] = 0;
        }
        $this->OverrideCommissionAmount = $data['OverrideCommissionAmount'];

        if(!(array_key_exists('Total', $data) && $data['Total'])){
            $data['Total'] = 0;
        }
        $this->Total = $data['Total'];


    }

}