<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackageStatus;
use TravelPAQ\PackagesAPI\Models\BookingStatus;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class BookingPackageService extends Service
{
	public function checkAvail($booking_id){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"booking/checkAvail/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new PackageStatus($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
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
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}	
	}
	public function getBooking($booking_id, $html){
		try {
			if($html)
				$response = $this->http_client->http_client->request('GET',"booking/getBooking/$booking_id", ['headers' => ['ACCEPT' => 'text/html']]);
			else 
				$response = $this->http_client->http_client->request('GET',"booking/getBooking/$booking_id");
			$body = $response->getBody()->getContents();
			if(!$html){
				$body_decoded = json_decode($body,true);
				if($body_decoded == null) {
					throw new \Exception($body);
				}
				return new BookingStatus($body_decoded);
			} else {
				return $body;
			}
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}

	}
	public function confirmBooking($booking_id){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"booking/confirmBooking/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}	
	}

	public function cancelBooking($booking_id){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"booking/cancelBooking/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
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