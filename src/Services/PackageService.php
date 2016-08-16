<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;

class PackageService extends Service
{
	public function all($params){

		$response = $this->http_client->http_client->request('POST',
								   'search/getPackageList',
								   ['body' => json_encode($params)]
								   );
		$body = $response->getBody();
		return $body;

	}
	public function find($id){

		$response = $this->http_client->http_client->request('GET',
								   "search/getPackage/$id");
		$body = $response->getBody();
		return $body;

	}
}
