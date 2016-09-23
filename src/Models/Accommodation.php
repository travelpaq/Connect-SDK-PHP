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
namespace TravelPAQ\PackagesAPI\Models;

use TravelPAQ\PackagesAPI\Exceptions\ValidationException;
/**
 * Class Accommodation
 *
 * @package TravelPAQ
 */
class Accommodation
{
	public $Hotel;
    /**
     * Constructor
     * @param Array data datos del hospedaje
     */
    public function __construct($data)
    {
		$this->Hotel = [];
        if(!array_key_exists('Hotel', $data))  
            throw new ValidationException("No se ha especificado el hotel");
		foreach ($data['Hotel'] as $key => $value) {
			$this->Hotel[] = new Hotel($value);
		}
    }

}