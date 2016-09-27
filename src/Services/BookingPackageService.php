<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackageStatus;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class BookingPackageService extends Service
{
	public function checkAvail($id){

		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"booking/checkAvail/$id");

			$body = $response->getBody()->getContents();
			echo $body;die();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
			}

			return new PackageStatus($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			echo $response_str;die();
			return $response_str;
		}
	}
	public function bookingPackage($params){
		
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST',
							 		   'booking/bookingPackage',
							 		   [
								 		   	'form_params' => 
							 		   		[
							 		   			'data' => base64_encode(json_encode($params))
							 		   		]
							 		   ]);
			$body = $response->getBody()->getContents();
			
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
			}
			return new BookingStatus($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}	
	}
	public function getBooking(){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"booking/getBooking/$id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
			}
			return new BookingStatus($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}
		
	}
	public function confirmBooking(){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"booking/confirmBooking/$id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
			}
			return new BookingStatus($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}
		
	}
	public function cancelBooking(){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"booking/cancelBooking/$id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
			}
			return new BookingStatus($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}
		
	}
}