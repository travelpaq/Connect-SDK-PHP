<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Core\PackageStatus;

class BookingPackageService extends Service
{
	public function checkAvail($id){
		$response = $this->http_client
						 ->http_client
						 ->request('GET',"booking/checkAvail/$id");

		$body = $response->getBody()->getContents();
		$body_decoded = json_decode($body,true);
		if($body_decoded == null){
			throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
		}
		if($response->getStatusCode() == 200){
			return new PackageStatus($body_decoded);
		} else {
			throw new \Exception("Se produjo un error interno y arrojo los siguientes datos: " . $response->getBody());
		}

	}
	public function bookingPackage($params){
		$response = $this->http_client
						 ->http_client
						 ->request('POST',
						 		   'booking/bookingPackage',
						 		   [
						 		   	'body' => base64_encode(json_encode($params))
						 		   ]);
		$body = $response->getBody()->getContents();
		$body_decoded = json_decode($body,true);
		if($body_decoded == null) {
			throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
		}
		if($response->getStatusCode() == 200){
			return new BookingStatus($body_decoded);
		} else {
			throw new \Exception("Se produjo un error interno y arrojo los siguientes datos: " . $response->getBody());
		}
	}
	public function getBookingPackage(){
		$response = $this->http_client
						 ->http_client
						 ->request('GET',"booking/getBooking/$id");
		$body = $response->getBody()->getContents();
		$body_decoded = json_decode($body,true);
		if($body_decoded == null) {
			throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
		}
		if($response->getStatusCode() == 200){
			return new BookingStatus($body_decoded);
		} else {
			throw new \Exception("Se produjo un error interno y arrojo los siguientes datos: " . $response->getBody());
		}
	}
}