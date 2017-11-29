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
 * Class Image
 *
 * @package TravelPAQ
 */
class Image
{
    public $picture;
    public $thumbnail;
    /**
     * Constructor
     * @param Array data datos del servicio
     */
    public function __construct($data)
    {
        if(!array_key_exists('picture', $data))
            $data['picture'] = "";
        $this->picture = $data['picture'];
        if(!array_key_exists('thumbnail', $data))
            $data['thumbnail'] = "";
        $this->thumbnail = $data['thumbnail'];
    }

}