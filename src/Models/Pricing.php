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
    public $NonCommissionableService;
    /*
    * @var ItemPriceLarge Impuestos de turísmo.
    */
    public $TourismTaxes;
    /*
    * @var ItemPriceLarge Impuestos fiscales.
    */
    public $FiscalTaxes;
    /*
    * @var float Precio comisionable.
    */
    public $commissionable_price;
    /*
    * @var float Comision de la OTA.
    */
    public $commission_amount;
    /*
    * @var float Sobrecarga de la comsión.
    */
    public $override_commission_amount;
    /*
    * @var float Total a pagar de la reserva
    */
    public $total;
    
    /**
     * Constructor
     * @param Array data datos del hospedaje
     */
    public function __construct($data)
    {
        $this->NonCommissionableService = [];
        if(array_key_exists('NonCommissionableService', $data))  {
            if(array_key_exists(0, ($data['NonCommissionableService']))){
                foreach ($data['NonCommissionableService'] as $key => $value) {
                    $this->NonCommissionableService[] = new ItemPriceShort($value);
                }
            } else {
                if($data['NonCommissionableService']){
                    $this->NonCommissionableService = array(new ItemPriceShort($data['NonCommissionableService']));
                }
            }
        }

        $this->TourismTaxes = [];
        if(array_key_exists('TourismTaxes', $data)) {
            if(array_key_exists(0, ($data['TourismTaxes']))){
                foreach ($data['TourismTaxes'] as $key => $value) {
                    $this->TourismTaxes[] = new ItemPriceLarge($value);
                }
            } else {
                if($data['TourismTaxes']){
                    $this->TourismTaxes = array(new ItemPriceLarge($data['TourismTaxes']));
                }
            }
        }

        $this->FiscalTaxes = [];
        if(array_key_exists('FiscalTaxes', $data)) {
            if(array_key_exists(0, ($data['FiscalTaxes']))){
                foreach ($data['FiscalTaxes'] as $key => $value) {
                    $this->FiscalTaxes[] = new ItemPriceLarge($value);
                }
            } else {
                if($data['FiscalTaxes']){
                    $this->FiscalTaxes = array(new ItemPriceLarge($data['FiscalTaxes']));
                }
            }
        }

        if(!(array_key_exists('commissionable_price', $data) && $data['commissionable_price'])){
            $data['commissionable_price'] = 0;
        }
        $this->commissionable_price = (float)$data['commissionable_price'];

        if(!(array_key_exists('commission_amount', $data) && $data['commission_amount'])){
            $data['commission_amount'] = 0;
        }
        $this->commission_amount = (float)$data['commission_amount'];

        if(!(array_key_exists('override_commission_amount', $data) && $data['override_commission_amount'])){
            $data['override_commission_amount'] = 0;
        }
        $this->override_commission_amount = (float)$data['override_commission_amount'];

        if(!(array_key_exists('total', $data) && $data['total'])){
            $data['total'] = 0;
        }
        $this->total = (float)$data['total'];


    }

}