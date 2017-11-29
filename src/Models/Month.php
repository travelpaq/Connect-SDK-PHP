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
 * Class Category
 *
 * @package TravelPAQ
 */
class Month
{
	public $name;
	public $number;
	public $year;
    /**
     * Constructor
     * @param Array data datos de la categoria
     */
    public function __construct($data)
    {
    	if(array_key_exists('month', $data)){
	    	$this->number = $data['month'];

	    	switch ($this->number) {
	    		case 1:{$this->name = 'Enero';break;}
	    		case 2:{$this->name = 'Febrero';break;}
	    		case 3:{$this->name = 'Marzo';break;}
	    		case 4:{$this->name = 'Abril';break;}
	    		case 5:{$this->name = 'Mayo';break;}
	    		case 6:{$this->name = 'Junio';break;}
				case 7:{$this->name = 'Julio';break;}
				case 8:{$this->name = 'Agosto';break;}
				case 9:{$this->name = 'Septiembre';break;}
				case 10:{$this->name = 'Octubre';break;}
				case 11:{$this->name = 'Noviembre';break;}
				case 12:{$this->name = 'Diciembre';break;}
	    	}

	    	if(!array_key_exists('year', $data))
	    		$data['year'] = "";
	    	$this->year = $data['year'];
    	} else {
	    	if(!array_key_exists('number', $data))
	    		$data['number'] = 0;
	    	$this->number = $data['number'];

	    	if(!array_key_exists('name', $data))
	    		$data['name'] = "";
	    	$this->name = $data['name'];

	    	if(!array_key_exists('year', $data))
	    		$data['year'] = "";
	    	$this->year = $data['year'];
    	}
    }

}