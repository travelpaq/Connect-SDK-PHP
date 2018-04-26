<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackageStatus;
use TravelPAQ\PackagesAPI\Models\BookingStatus;
use TravelPAQ\PackagesAPI\Models\BookingStatusTravelPAQ;
use TravelPAQ\PackagesAPI\Models\BookingsPagination;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class BookingPackageService extends Service
{
	public function checkAvail($package_id){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"packages/check_avail/$package_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
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
		
		$params['rooms'] = $params['Room'];
		unset($params['Room']);

		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST',
							 		   'bookings',
							 		   [
								 		   	'json' => $params,
							 		   		'header'=>['Accept'=>'application/json']
							 		   		
							 		   ]);
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded['booking']);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}	
	}
	public function getBooking($booking_id, $html){
		try {
			
			$response = $this->http_client->http_client->request('GET',"bookings/$booking_id");
			
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			
			if(!is_array($body_decoded) && $body_decoded == null) {
				throw new \Exception($body);
			}
			if(array_key_exists('Passenger', $body_decoded))
				return $body_decoded;
			else {
				if(array_key_exists('percentage_tp_ota', $body_decoded) && array_key_exists('percentage_tp_operator', $body_decoded) && $body_decoded['percentage_tp_ota'] && $body_decoded['percentage_tp_operator']){
					return new BookingStatusTravelPAQ($body_decoded['booking']);
				} else {
					return new BookingStatus($body_decoded['booking']);
				}
			}
			

		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}

	}

	public function getBookingList($status = 'ALL', $page = 0, $sizeOfPage = 10){
		try {
			$response = $this->http_client->http_client->request('GET', 'Booking/getBookingList/' . $status . '/' . $page . '/' . $sizeOfPage);
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new BookingsPagination($body_decoded);
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
							 ->request('GET',"bookings/confirm/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded['booking']);
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
							 ->request('GET',"bookings/cancel/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded['booking']);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}	
	}

	public function iConfirmBooking($booking_id){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"bookings/iConfirm/$booking_id");


			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded['booking']);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}	
	}

	public function iCancelBooking($booking_id){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET',"bookings/iCancel/$booking_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null) {
				throw new \Exception($body);
			}
			return new BookingStatus($body_decoded['booking']);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;			
		}	
	}
}