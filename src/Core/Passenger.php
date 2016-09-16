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
    public function __construct($data)
    {
		if(!array_key_exists('name', $data))
			$data['name'] = '';
		$this->name = $data['name'];
		if(!array_key_exists('surname', $data))
			$data['surname'] = '';
		$this->surname = $data['surname'];
		if(!array_key_exists('kind_doc', $data))
			$data['kind_doc'] = '';
		$this->kind_doc = $data['kind_doc'];
		if(!array_key_exists('num_doc', $data))
			$data['num_doc'] = '';
		$this->num_doc = $data['num_doc'];
		if(!array_key_exists('gender', $data))
			$data['gender'] = '';
		$this->gender = $data['gender'];
		if(!array_key_exists('birthdate', $data))
			$data['birthdate'] = '';
		$this->birthdate = $data['birthdate'];
		if(!array_key_exists('residence', $data))
			$data['residence'] = '';
		$this->residence = $data['residence'];
		if(!array_key_exists('nationality', $data))
			$data['nationality'] = '';
		$this->nationality = $data['nationality'];
		if(!array_key_exists('mail', $data))
			$data['mail'] = '';
		$this->mail = $data['mail'];
		
		$this->Passport = new Passport($data['Passport']);
    }

}