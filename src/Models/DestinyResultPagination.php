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
 * Class DestinyResultPagination
 * 
 * Clase que contiene un listado de destinos
 *
 * @package TravelPAQ
 */
class DestinyResultPagination
{
	/*
	* Listade de items
	*/
	public $result;

	/*
	* Pagina actual
	*/
	public $current_page;

	/*
	* Cantidad de páginas 
	*/
	public $total_page;

	/*
	* Cantidad de items por página de resultado
	*/
	public $item_per_page;

	/*
	* Cantidad total de items
	*/
	public $total_items;

    /**
     * Constructor
     * @param Array Representa el resultado de destino
     */
    public function __construct($data)
    {	

		$this->result = [];
		if(array_key_exists('result', $data) && $data['result']){
			foreach($data['result'] as $item){
				$this->result[] = new DestinyResult($item);
			}
		}

		$this->current_page = 0;
		if(array_key_exists('current_page', $data) && $data['current_page'])
			$this->current_page = $data['current_page'];

		$this->total_page = 0;
		if(array_key_exists('total_page', $data) && $data['total_page'])
			$this->total_page = $data['total_page'];

		$this->item_per_page = 0;
		if(array_key_exists('item_per_page', $data) && $data['item_per_page'])
			$this->item_per_page = $data['item_per_page'];

		$this->total_items = 0;
		if(array_key_exists('total_items', $data) && $data['total_items'])
			$this->total_items = $data['total_items'];

    }
}