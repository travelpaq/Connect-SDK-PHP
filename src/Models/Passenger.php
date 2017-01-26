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
 * Class Passenger
 * 
 * Clase que contiene datos de un paquete
 *
 * @package TravelPAQ
 */
class Passenger
{
	/*
	* @var string Nombre del pasajero
	*/
	public $name;
	/*
	* @var string Apellido del pasajero
	*/
	public $surname;
	/*
	* @var string Tipo de documento
	*/
	public $kind_doc;
	/*
	* @var string Número de documento
	*/
	public $num_doc;
	/*
	* @var string Género
	*/
	public $gender;
	/*
	* @var string Fecha de nacimiento
	*/
	public $birthdate;
	/*
	* @var string País de residencia
	*/
	public $residence;
	/*
	* @var string Nacionalidad
	*/
	public $nationality;
	/*
	* @var string Mail
	*/
	public $mail;
	/*
	* @var Passport Datos del pasaporte
	*/
	public $Passport;
    
    /**
     * Constructor
     * @param data 
     */
    public function __construct(Array $data)
    {
		
		if(!array_key_exists('name', $data))
			throw new ValidationException("Falta el campo 'name'");
		else
			$this->name = $data['name'];
		
		if(!array_key_exists('surname', $data))
			throw new ValidationException("Falta el campo 'surname'");
		else
			$this->surname = $data['surname'];
		
		if(!array_key_exists('kind_doc', $data))
			throw new ValidationException("Falta el campo 'kind_doc'");
		else
			$this->kind_doc = $data['kind_doc'];
		
		if(!array_key_exists('num_doc', $data))
			throw new ValidationException("Falta el campo 'num_doc'");
		else
			$this->num_doc = $data['num_doc'];
		
		if(!array_key_exists('gender', $data))
			throw new ValidationException("Falta el campo 'gender'");
		else
			$this->gender = $data['gender'];
		
		if(!array_key_exists('birthdate', $data))
			throw new ValidationException("Falta el campo 'birthdate'");
		else
			$this->birthdate = $data['birthdate'];
		
		if(!array_key_exists('residence', $data))
			throw new ValidationException("Falta el campo 'residence'");
		else
			$this->residence = $data['residence'];
		
		if(!array_key_exists('nationality', $data))
			throw new ValidationException("Falta el campo 'nationality'");
		else
			$this->nationality = $data['nationality'];
		
		if(!array_key_exists('mail', $data))
			throw new ValidationException("Falta el campo 'mail'");
		else
			$this->mail = $data['mail'];
		
		if($this->kind_doc == 'Pasaporte') {
			if(array_key_exists('Passport', $data) && $data['Passport'])
				$this->Passport = new Passport($data['Passport']);
			else 
				$this->Passport = [];
		} 
    }

}