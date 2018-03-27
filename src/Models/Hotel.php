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
 * Class Hotel
 *
 * @package TravelPAQ
 */
class Hotel
{
    public $star_rating;
    public $name;
    public $Place;
    public $address;
    public $lat;
    public $lng;
    public $url;
    public $tripadvisor_rating;
    public $popularity;
    public $description;
    public $Regimes;
    public $RoomsKind;
    public $Image;

    /**
     * Constructor
     * @param Array data datos de la salida
     */
    public function __construct($data)
    {
        if(array_key_exists('Place', $data))
            $this->Place = new Place($data['Place']);
        else 
            $this->Place = [];
        
        if(array_key_exists('name', $data))
            $this->name = $data['name'];
        else 
            $this->name = '';
        
        if(array_key_exists('star_rating', $data))
            $this->star_rating = (int)$data['star_rating'];
        else 
            $this->star_rating = 0;
        
        if(array_key_exists('address', $data))
            $this->address = $data['address'];
        else 
            $this->address = '';
        
        if(array_key_exists('lat', $data))
            $this->lat = $data['lat'];
        else 
            $this->lat = '';
        
        if(array_key_exists('lng', $data))
            $this->lng = $data['lng'];
        else 
            $this->lng = '';
        
        if(array_key_exists('url', $data))
            $this->url = $data['url'];
        else 
            $this->url = '';
        
        if(array_key_exists('tripadvisor_rating', $data))
            $this->tripadvisor_rating = (float)$data['tripadvisor_rating'];
        else 
            $this->tripadvisor_rating = 0;
        
        if(array_key_exists('popularity', $data))
            $this->popularity = (int)$data['popularity'];
        else 
            $this->popularity = 0;
        
        if(array_key_exists('description', $data))
            $this->description = $data['description'];
        else 
            $this->description = '';

        if(array_key_exists('Regimes', $data))
            $this->Regimes = $data['Regimes'];
        else 
            $this->Regimes = [];

        if(array_key_exists('RoomsKind', $data))
            $this->RoomsKind = $data['RoomsKind'];
        else 
            $this->RoomsKind = [];

        $this->Image = [];
        if(array_key_exists('images', $data)){
            foreach ($data['images'] as $key => $value) {
                $this->Image[] = new Image($value);
            }
        }
    }
}