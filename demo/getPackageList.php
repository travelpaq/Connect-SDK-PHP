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
	* Conversión de los parámetros
    * Los parametros de entrada deben tener estructura similar al siguiente ejemplo
	* array
	*	(
    *		    [order_type] => DESC
    *		    [order_field] => PRICE
    *		    [currency] => ARS
    *		    [origin_place] => BUE
    *		    [destination_place] => IGR
    *		    [month_departure] => 10
    *		    [year_departure] => 2016
    *		    [Room] => Array
    *		        (
    *		            [0] => array
    *		                (
    *		                    [adult] => 2
    *		                    [Children] => Array
    *		                        (
    *		                            [0] => array
    *		                                (
    *		                                    [age] => 2
    *		                                )
	*
    *		                        )
	*
    *		                )
	*
    *		        )
	*
	*	)
	* 
	* Este formato será convertido correctamente por el SDK
	*/

	$request_params = json_decode(file_get_contents('php://input'),true);

	try{
		/**
		* 
		* LLamada al método getPackageList con los parámetros para obtener resultados
		*
		*/
		$response = $tp->getPackageList($request_params,0);

		/**
		* 
		* Impresion de resultados obtenidos
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