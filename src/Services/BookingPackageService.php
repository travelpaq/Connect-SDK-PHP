<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;

class BookingPackageService extends Service
{
	public function checkAvail($id){

		$response = $this->http_client->http_client->request('GET',
								   "booking/checkAvail/$id");
		$body = $response->getBody();
		return $body;

	}
	public function book($params){

		$response = $this->http_client->http_client->request('POST',
								   'booking/bookingPackage',
								   ['body' => json_encode($params)]
								   );

		$body = $response->getBody();
		return $body;

	}
	public function find(){

		$response = $this->http_client->http_client->request('GET',
								   "booking/find/$id");
		$body = $response->getBody();
		return $body;

	}
}
