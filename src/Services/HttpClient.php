<?php

namespace TravelPAQ\Service\Http_Client;

use GuzzleHttp\Client;

public class Http_Client
{
	private static $instance;
	private $http_client;

    public static function getInstance($params = []){
    	if (null === static::$instance) {
            static::$instance = new static($params);
        }
        
        return static::$instance;
    } 
    protected function __construct(Array $params)
    {
    	if(!array_key_exists('url', $params))
    		throw new Exception('Falta la URL para la API.');
    	if(!array_key_exists('timeout', $params))
    		$params['timeout'] = 2.0;
    	if(array_key_exists('key', $params))
    		throw new Exception('Falta la KEY para la API.');
    		
    	$this->http_client = new Client([
		    'base_uri' => $params['url'],
		    'timeout'  => $params['timeout'],
		]);
		$client->setDefaultOption('headers/TP-AUTH', $params['key']);
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
}