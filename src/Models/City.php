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
 * Class City
 *
 * @package TravelPAQ
 */
class City extends Place implements \JsonSerializable
{

    public function jsonSerialize() {
        return [
        	'name' => $this->name,
        	'iata' => $this->iata,
        	'Country' => $this->Country
		];
    }

}