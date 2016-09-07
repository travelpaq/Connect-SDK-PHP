<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   Facundo J Gonzalez <facujgg@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Core;

use TravelPAQ\PackagesAPI\Exceptions\ValidationException;
/**
 * Class Category
 *
 * @package TravelPAQ
 */
class Category
{
	var $name;
    /**
     * Constructor
     * @param Array data datos de la categoria
     */
    public function __construct($data)
    {
    	if(!array_key_exists('name', $params))
    		$data['name'] = "";
    	$this->name = $data['name'];
    }

}