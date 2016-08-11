<?php
public class TravelPAQ{
	var $token = '';
	function __construct($token = null)
	{
		if(!$token)
			throw new Exception("Falta token", 1);
		$this->token = $token;
	}
	public function getPackageList(Array $params){
		
	}
	public function getPackage($id){
		
	}

	public function checkAvail(Array $params){
		
	}

	public function bookingPackage(Array $params){
		
	}

	public function getBookingPackage(Array $params){
		
	}
}