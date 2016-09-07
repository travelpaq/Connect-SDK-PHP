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
 * Class Destination
 *
 * @package TravelPAQ
 */
class Destination extends Place
{
    public $Country;
    /**
     * Constructor
     * @param Array data datos de un destino
     */
    public function __construct($data)
    {
    	parent::__construct($data);
        $this->Country = new Place($data['Country']);
    }

}