<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;

class PackageService extends Service
{
	public function all($params){

		$response = $this->http_client->http_client->request('POST',
								   'Packages/getPackageList',
								   [
									    'form_params' => [
									        'data' => base64_encode(json_encode($params))
									    ]
									]);
		$body = $response->getBody()->getContents();

		return $body;

	}
	public function find($id){

		$response = $this->http_client->http_client->request('GET',
								   "Packages/getPackage/$id");
		$body = $response->getBody()->getContents();
		return $body;

	}
}
