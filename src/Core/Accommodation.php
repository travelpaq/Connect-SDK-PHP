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
		foreach ($data['Hotel'] as $key => $value) {
			$this->Hotel[] = new Hotel($value);
		}
    }

}