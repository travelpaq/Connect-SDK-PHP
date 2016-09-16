<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Core\PackagesPagination;
use TravelPAQ\PackagesAPI\Core\Package;

class PackageService extends Service
{
	public function getPackageList($params, $page = 0){
		$response = $this->http_client
						->http_client
						->request('POST', 
						 		   'Packages/getPackageList/' . $page,
						 		   [
						 		   		'form_params' => 
						 		   		[
						 		   			'data' => base64_encode(json_encode($params))
						 		   		]
						 		   	]
						 );
		$body = $response->getBody()->getContents();
		$body_decoded = json_decode($body,true);
		if($body_decoded == null){
			throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
		}
		
		if($response->getStatusCode() == 200){
			return new PackagesPagination($body_decoded);
		} else {
			throw new \Exception("Se produjo un error interno y arrojo los siguientes datos: " . $response->getBody());
		}
	}
	
	public function getPackage($id){
		$response = $this->http_client
						 ->http_client
						 ->request('GET',"Packages/getPackage/$id");
		$body = $response->getBody()
						 ->getContents();
		$body_decoded = json_decode($body,true);
		if($body_decoded == null){
			throw new \Exception("El JSON que se ha retornado no es correcto debído a un error interno de la API");
		}

		if($response->getStatusCode() == 200){
			return new Package($body_decoded);
		} else {
			throw new \Exception("Se produjo un error interno y arrojo los siguientes datos: " . $response->getBody());
		}
	}
}
