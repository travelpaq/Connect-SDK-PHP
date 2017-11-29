<?php

namespace TravelPAQ\PackagesAPI\Services;

use GuzzleHttp\Client;

class HttpClient
{
	private static $instance;
	var $http_client;

    public static function getInstance($params = []){
    	if (null === static::$instance) {
            static::$instance = new static($params);
        }
        
        return static::$instance;
    } 
    protected function __construct(Array $params)
    {
    	if(!array_key_exists('url', $params))
    		throw new \Exception('Falta la URL para la API.');
    	if(!array_key_exists('timeout', $params))
            set_time_limit(200);
    		$params['timeout'] = 200.0;
    	if(!array_key_exists('key', $params))
    		throw new \Exception('Falta la KEY para la API.');
    		
    	$this->http_client = new Client([
		    'base_uri' => $params['url'],
		    'timeout'  => $params['timeout'],
            'verify'   => __DIR__.'/cacert.pem',
                    'headers' => [
                            'TP-AUTH' => $params['key'],
                            'TP-IPP' => $params['item_per_page'],
                            'ACCEPT' => 'application/json'
                          ]
		]);
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
}
