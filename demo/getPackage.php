<?php

	require "../vendor/autoload.php";
	use TravelPAQ\PackagesAPI\PackagesAPI;

	/**
	*
	* Se crea una instancia de PackageAPI para poder acceder a los métodos de la API
	*
	*/
	$tp = new PackagesAPI
		(
			[
				/**
				*
				* api_key es el identificador necesario de la empresa de turismo para poder iniciar interacciones con la API
				*
				*/
				'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA',
				/**
				* 
				* item_per_page es la cantidad de paquetes que retornará la búsqueda en cada llamada
				*
				*/
				'item_per_page' => 5
			]
		);

	/**
	*
	* Obtengo el id del paquete enviado como parametro por GET
	*
	*/
	$package_id = $_GET["id"];

	try{
		/**
		* 
		* LLamada al método getPackage con el identificador enviado para obtener el paquete
		*
		*/
		$response = $tp->getPackage($package_id);
		/**
		* 
		* Impresion del paquete obtenido
		*
		*/
		echo json_encode($response, JSON_PRETTY_PRINT);
	} catch(Exception $e){
		/**
		*
		* La captura de excepciones es responsabilidad de la OTA que implemente el SDK en su sitio WEB, 
		* al igual que el protocolo que se lleve a cabo cuando esto sucesa.
		* Para el caso de este demo solo muestra en pantalla el mensaje de error.
		*
		*/
		echo $e->getMessage();
	}