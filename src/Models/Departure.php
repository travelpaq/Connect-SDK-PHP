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
 * Class Departure
 *
 * @package TravelPAQ
 */
class Departure
{
    public $date;
    public $transport_kind;
    public $Route;
    public $Place;
    /**
     * Constructor
     * @param Array data datos de la salida
     */
    public function __construct($data)
    {
		$this->Route = [];
		foreach ($data['Route'] as $key => $value) {
			$this->Route[] = new Route($value);
		}
        $this->Place = new Place($data['Place']);

        if(!array_key_exists('date', $data))
            $data['date'] = "";
        $this->date = $data['date'];

        if(!array_key_exists('transport_kind', $data))
            $data['transport_kind'] = "";
        $this->transport_kind = $data['transport_kind'];
    }

}