materialAdmin
    // =========================================================================
    // Base controller for common functions
    //
    // Google API Maps AIzaSyDouPX1X-bA4y_h28oKRcBK26s2RXQl7xE
    // =========================================================================

    .controller('materialadminCtrl', function($scope, $http){ //sacado el state porque fallaba y no se donde se usaba
        
            $scope.params = {};
            $scope.params.order_type = "DESC";
            $scope.params.order_field = "PRICE";
            $scope.params.currency = "ARS";
            $scope.params.origin_place = "BUE";
            $scope.params.destination_place = "IGR";
            $scope.params.month_departure = 10;
            $scope.params.year_departure = 2016;
            $scope.params.Room = [];
            $scope.rooms = 1;

            $scope.children = [];
            $scope.response = {};

            $scope.selected_package = null;
            $scope.checked_package = null;

            $scope.Booking = {"package_fare_id":0, "Passenger":[]};

            $scope.getBooking = "";

            $scope.origins_place = [{'id':'BHI', 'name':'Bahía Blanca, Argentina'},{'id':'BUE', 'name':'Buenos Aires, Argentina'},{'id':'COR', 'name':'Córdoba, Argentina'},{'id':'CTC', 'name':'Catamarca, Argentina'},{'id':'CPC', 'name':'Chapelco, Argentina'},{'id':'CRD', 'name':'Comodoro Rivadavia, Argentina'},{'id':'CNQ', 'name':'Corrientes, Argentina'},{'id':'FTE', 'name':'El Calafate, Argentina'},{'id':'EQS', 'name':'Esquel, Argentina'},{'id':'FMA', 'name':'Formosa, Argentina'},{'id':'IGR', 'name':'Iguazú, Argentina'},{'id':'JUJ', 'name':'Jujuy, Argentina'},{'id':'IRJ', 'name':'La Rioja, Argentina'},{'id':'MDQ', 'name':'Mar del Plata, Argentina'},{'id':'MDZ', 'name':'Mendoza, Argentina'},{'id':'NQN', 'name':'Neuquen, Argentina'},{'id':'PSS', 'name':'Posadas, Argentina'},{'id':'RGL', 'name':'Río Gallegos, Argentina'},{'id':'RGA', 'name':'Río Grande, Argentina'},{'id':'RES', 'name':'Resistencia, Argentina'},{'id':'ROS', 'name':'Rosario, Argentina'},{'id':'SLA', 'name':'Salta, Argentina'},{'id':'BRC', 'name':'San Carlos de Bariloche, Argentina'},{'id':'UAQ', 'name':'San Juan, Argentina'},{'id':'LUQ', 'name':'San Luis, Argentina'},{'id':'AFA', 'name':'San Rafael, Argentina'},{'id':'SFN', 'name':'Santa Fe, Argentina'},{'id':'SDE', 'name':'Santiago del Estero, Argentina'},{'id':'REL', 'name':'Trelew, Argentina'},{'id':'TUC', 'name':'Tucum, Argentina'},{'id':'USH', 'name':'Ushuaia, Argentina'},{'id':'VDM', 'name':'Viedma, Argentina'}];
            $scope.destinations_place = [
                                    {'id':'LAD', 'name':'Luanda, Angola'},
                                    {'id':'ALG', 'name':'Argel, Argelia'},
                                    {'id':'ORN', 'name':'Or, Argelia'},
                                    {'id':'COO', 'name':'Cotonou, Ben'},
                                    {'id':'GBE', 'name':'Gaborone, Botsuana'},
                                    {'id':'BJM', 'name':'Bujumbura, Burundi'},
                                    {'id':'SID', 'name':'Isla Sal, Cabo Verde, República de'},
                                    {'id':'RAI', 'name':'Praia, Cabo Verde, República de'},
                                    {'id':'DLA', 'name':'Douala, Camerún, República de'},
                                    {'id':'YVA', 'name':'Moroni, Comoras'},
                                    {'id':'YVA', 'name':'Moroni, Comoras'},
                                    {'id':'BZV', 'name':'Brazzaville, Congo'},
                                    {'id':'ABJ', 'name':'Abidjan, Costa de Marfil'},
                                    {'id':'ASW', 'name':'Asu, Egipto'},
                                    {'id':'CAI', 'name':'El Cairo, Egipto'},
                                    {'id':'ASM', 'name':'Asmara, Eritrea'},
                                    {'id':'ADD', 'name':'Addis Abeba, Etiop'},
                                    {'id':'DIR', 'name':'Dire Dawa, Etiop'},
                                    {'id':'ACC', 'name':'Accra, Ghana'},
                                    {'id':'CKY', 'name':'Conakry, Guinea'},
                                    {'id':'OXB', 'name':'Bissau, Guinea Bissau'},
                                    {'id':'SSG', 'name':'Malabo, Guinea Ecuatorial'},
                                    {'id':'SEZ', 'name':'Isla Mahe, Islas Seychelles'},
                                    {'id':'NBO', 'name':'Nairobi, Kenia'},
                                    {'id':'NBO', 'name':'Nairobi, Kenia'},
                                    {'id':'DIE', 'name':'Diego Suárez, Madagascar'},
                                    {'id':'BKO', 'name':'Bamako, Mal'},
                                    {'id':'BLZ', 'name':'Blantyre, Malawi'},
                                    {'id':'AGA', 'name':'Agadir, Marruecos'},
                                    {'id':'CAS', 'name':'Casablanca, Marruecos'},
                                    {'id':'CAS', 'name':'Casablanca, Marruecos'},
                                    {'id':'FEZ', 'name':'Fez Ma, Marruecos'},
                                    {'id':'RAK', 'name':'Marraquech, Marruecos'},
                                    {'id':'RBA', 'name':'Rabat, Marruecos'},
                                    {'id':'TNG', 'name':'Tánger, Marruecos'},
                                    {'id':'MRU', 'name':'Mauricio, Mauricio'},
                                    {'id':'MPM', 'name':'Maputo, Mozambique'},
                                    {'id':'NIM', 'name':'Niamey, Níger'},
                                    {'id':'WVB', 'name':'Walvis Bay, Namibia'},
                                    {'id':'ABV', 'name':'Abuja, Nigeria'},
                                    {'id':'LOS', 'name':'Lagos, Nigeria'},
                                    {'id':'DKR', 'name':'Dakar, Senegal'},
                                    {'id':'JNB', 'name':'Aeropuerto Internacional Johannesburgo, Sudáfrica'},
                                    {'id':'JNB', 'name':'Aeropuerto Internacional Johannesburgo, Sudáfrica'},
                                    {'id':'CPT', 'name':'Ciudad del Cabo, Sudáfrica'},
                                    {'id':'DUR', 'name':'Durban, Sudáfrica'},
                                    {'id':'DUR', 'name':'Durban, Sudáfrica'},
                                    {'id':'JNB', 'name':'Johannesburgo, Sudáfrica'},
                                    {'id':'JNB', 'name':'Johannesburgo, Sudáfrica'},
                                    {'id':'PLZ', 'name':'Port Elizabeth, Sudáfrica'},
                                    {'id':'PRY', 'name':'Pretoria, Sudáfrica'},
                                    {'id':'UTT', 'name':'Umtata, Sudáfrica'},
                                    {'id':'TUN', 'name':'Tunis, Túnez'},
                                    {'id':'DAR', 'name':'Dar Es Salaam, Tanzania'},
                                    {'id':'EBB', 'name':'Entebbe, Uganda'},
                                    {'id':'BEN', 'name':'Benghazi, Yamahiriya Árabe Libia'},
                                    {'id':'TIP', 'name':'Trípoli, Yamahiriya Árabe Libia'},
                                    {'id':'LUN', 'name':'Lusaka, Zambia'},
                                    {'id':'BUQ', 'name':'Bulawayo, Zimbabue'},
                                    {'id':'VFA', 'name':'Cataratas Victoria, Zimbabue'},
                                    {'id':'HRE', 'name':'Harare, Zimbabue'},
                                    {'id':'YBG', 'name':'Bagotville, Canadá'},
                                    {'id':'ZBF', 'name':'Bathurst, Canadá'},
                                    {'id':'YYC', 'name':'Calgary, Canadá'},
                                    {'id':'YMT', 'name':'Chibougamau, Canadá'},
                                    {'id':'YDF', 'name':'Deer Lake (Newfoundland), Canadá'},
                                    {'id':'YVZ', 'name':'Deer Lake (Ontario), Canadá'},
                                    {'id':'YEA', 'name':'Edmonton, Canadá'},
                                    {'id':'YEA', 'name':'Edmonton, Canadá'},
                                    {'id':'YMM', 'name':'Fort McMurray, Canadá'},
                                    {'id':'YXJ', 'name':'Fort Saint John, Canadá'},
                                    {'id':'YQX', 'name':'Gander, Canadá'},
                                    {'id':'YGP', 'name':'Gaspe, Canadá'},
                                    {'id':'YYR', 'name':'Goose Bay, Canadá'},
                                    {'id':'YQU', 'name':'Grande Prairie, Canadá'},
                                    {'id':'YHZ', 'name':'Halifax, Canadá'},
                                    {'id':'YGR', 'name':'Islas Magdalena, Canadá'},
                                    {'id':'YQL', 'name':'Lethbridge, Canadá'},
                                    {'id':'YXH', 'name':'Medicine Hat, Canadá'},
                                    {'id':'YMQ', 'name':'Montreal, Canadá'},
                                    {'id':'YMQ', 'name':'Montreal, Canadá'},
                                    {'id':'YMQ', 'name':'Montreal, Canadá'},
                                    {'id':'YYB', 'name':'North Bay, Canadá'},
                                    {'id':'YOW', 'name':'Ottawa, Canadá'},
                                    {'id':'YOW', 'name':'Ottawa, Canadá'},
                                    {'id':'YXS', 'name':'Prince George, Canadá'},
                                    {'id':'YPR', 'name':'Prince Rupert, Canadá'},
                                    {'id':'YPR', 'name':'Prince Rupert, Canadá'},
                                    {'id':'YQB', 'name':'Quebec, Canadá'},
                                    {'id':'YQZ', 'name':'Quesnel, Canadá'},
                                    {'id':'YQR', 'name':'Regina, Canadá'},
                                    {'id':'YUY', 'name':'Rouyn Noranda, Canadá'},
                                    {'id':'YYT', 'name':'Saint Johns, Canadá'},
                                    {'id':'YZP', 'name':'Sandspit, Canadá'},
                                    {'id':'YXE', 'name':'Saskatoon, Canadá'},
                                    {'id':'YAM', 'name':'Sault Sainte Marie, Canadá'},
                                    {'id':'YZV', 'name':'Sept Iles, Canadá'},
                                    {'id':'YQT', 'name':'Thunder Bay, Canadá'},
                                    {'id':'YTO', 'name':'Toronto, Canadá'},
                                    {'id':'YTO', 'name':'Toronto, Canadá'},
                                    {'id':'YTO', 'name':'Toronto, Canadá'},
                                    {'id':'YVR', 'name':'Vancouver, Canadá'},
                                    {'id':'YVR', 'name':'Vancouver, Canadá'},
                                    {'id':'YWK', 'name':'Wabush, Canadá'},
                                    {'id':'YXY', 'name':'Whitehorse, Canadá'},
                                    {'id':'YWL', 'name':'Williams Lake, Canadá'},
                                    {'id':'YWG', 'name':'Winnipeg, Canadá'},
                                    {'id':'YZF', 'name':'Yellowknife, Canadá'},
                                    {'id':'ANC', 'name':'Anchorage, Estados Unidos'},
                                    {'id':'ATL', 'name':'Atlanta, Estados Unidos'},
                                    {'id':'ATL', 'name':'Atlanta, Estados Unidos'},
                                    {'id':'ATL', 'name':'Atlanta, Estados Unidos'},
                                    {'id':'ATL', 'name':'Atlanta, Estados Unidos'},
                                    {'id':'BOS', 'name':'Boston, Estados Unidos'},
                                    {'id':'BUF', 'name':'Buffalo, Estados Unidos'},
                                    {'id':'CHS', 'name':'Charleston (South Carolina), Estados Unidos'},
                                    {'id':'CHI', 'name':'Chicago, Estados Unidos'},
                                    {'id':'CHI', 'name':'Chicago, Estados Unidos'},
                                    {'id':'CHI', 'name':'Chicago, Estados Unidos'},
                                    {'id':'CHI', 'name':'Chicago, Estados Unidos'},
                                    {'id':'CHI', 'name':'Chicago, Estados Unidos'},
                                    {'id':'CVG', 'name':'Cincinnati, Estados Unidos'},
                                    {'id':'CVG', 'name':'Cincinnati, Estados Unidos'},
                                    {'id':'CLE', 'name':'Cleveland, Estados Unidos'},
                                    {'id':'CLE', 'name':'Cleveland, Estados Unidos'},
                                    {'id':'CLE', 'name':'Cleveland, Estados Unidos'},
                                    {'id':'DFW', 'name':'Dallas, Estados Unidos'},
                                    {'id':'DFW', 'name':'Dallas, Estados Unidos'},
                                    {'id':'DAY', 'name':'Dayton, Estados Unidos'},
                                    {'id':'DEN', 'name':'Denver, Estados Unidos'},
                                    {'id':'DTT', 'name':'Detroit, Estados Unidos'},
                                    {'id':'PHL', 'name':'Filadelfia, Estados Unidos'},
                                    {'id':'PHL', 'name':'Filadelfia, Estados Unidos'},
                                    {'id':'HOU', 'name':'Houston, Estados Unidos'},
                                    {'id':'HOU', 'name':'Houston, Estados Unidos'},
                                    {'id':'JNU', 'name':'Juneau, Estados Unidos'},
                                    {'id':'LAS', 'name':'Las Vegas - Nevada, Estados Unidos'},
                                    {'id':'LAS', 'name':'Las Vegas - Nevada, Estados Unidos'},
                                    {'id':'LAX', 'name':'Los Ángeles, Estados Unidos'},
                                    {'id':'LAX', 'name':'Los Ángeles, Estados Unidos'},
                                    {'id':'MHT', 'name':'Manchester, Estados Unidos'},
                                    {'id':'MEM', 'name':'Memphis, Estados Unidos'},
                                    {'id':'MEM', 'name':'Memphis, Estados Unidos'},
                                    {'id':'MIA', 'name':'Miami, Estados Unidos'},
                                    {'id':'MSP', 'name':'Minneapolis, Estados Unidos'},
                                    {'id':'MSP', 'name':'Minneapolis, Estados Unidos'},
                                    {'id':'APF', 'name':'Nápoles, Estados Unidos'},
                                    {'id':'NYC', 'name':'Nueva York, Estados Unidos'},
                                    {'id':'NYC', 'name':'Nueva York, Estados Unidos'},
                                    {'id':'NYC', 'name':'Nueva York, Estados Unidos'},
                                    {'id':'ORL', 'name':'Orlando, Estados Unidos'},
                                    {'id':'PHX', 'name':'Phoenix, Estados Unidos'},
                                    {'id':'ROC', 'name':'Rochester (New York), Estados Unidos'},
                                    {'id':'SLC', 'name':'Salt Lake City, Estados Unidos'},
                                    {'id':'SAN', 'name':'San Diego, Estados Unidos'},
                                    {'id':'SAN', 'name':'San Diego, Estados Unidos'},
                                    {'id':'SAN', 'name':'San Diego, Estados Unidos'},
                                    {'id':'SAN', 'name':'San Diego, Estados Unidos'},
                                    {'id':'SEA', 'name':'Seattle, Estados Unidos'},
                                    {'id':'WAS', 'name':'Washington (District of Columbia), Estados Unidos'},
                                    {'id':'WAS', 'name':'Washington (District of Columbia), Estados Unidos'},
                                    {'id':'WAS', 'name':'Washington (District of Columbia), Estados Unidos'},
                                    {'id':'ACA', 'name':'Acapulco, México'},
                                    {'id':'AGU', 'name':'Aguascalientes, México'},
                                    {'id':'CPE', 'name':'Campeche, México'},
                                    {'id':'CUN', 'name':'Cancún, México'},
                                    {'id':'CUU', 'name':'Chihuahua, México'},
                                    {'id':'MEX', 'name':'Ciudad de México, México'},
                                    {'id':'CME', 'name':'Ciudad del Carmen, México'},
                                    {'id':'CJS', 'name':'Ciudad Juárez, México'},
                                    {'id':'CEN', 'name':'Ciudad Obregón, México'},
                                    {'id':'CLQ', 'name':'Colima, México'},
                                    {'id':'CZM', 'name':'Cozumel, México'},
                                    {'id':'CUL', 'name':'Culiac, México'},
                                    {'id':'DGO', 'name':'Durango, México'},
                                    {'id':'GDL', 'name':'Guadalajara, México'},
                                    {'id':'GYM', 'name':'Guaymas, México'},
                                    {'id':'HMO', 'name':'Hermosillo, México'},
                                    {'id':'HUX', 'name':'Huatulco, México'},
                                    {'id':'LAP', 'name':'La Paz, México'},
                                    {'id':'BJX', 'name':'León, México'},
                                    {'id':'SJD', 'name':'Los Cabos, México'},
                                    {'id':'LMM', 'name':'Los Mochis, México'},
                                    {'id':'MID', 'name':'Mérida, México'},
                                    {'id':'MAM', 'name':'Matamoros, México'},
                                    {'id':'MZT', 'name':'Mazatl, México'},
                                    {'id':'MXL', 'name':'Mexicali, México'},
                                    {'id':'MTT', 'name':'Minatitl, México'},
                                    {'id':'MTY', 'name':'Monterrey, México'},
                                    {'id':'MTY', 'name':'Monterrey, México'},
                                    {'id':'MLM', 'name':'Morelia, México'},
                                    {'id':'NLD', 'name':'Nuevo Laredo, México'},
                                    {'id':'OAX', 'name':'Oaxaca, México'},
                                    {'id':'PAZ', 'name':'Poza Rica, México'},
                                    {'id':'PBC', 'name':'Puebla, México'},
                                    {'id':'PVR', 'name':'Puerto Vallarta, México'},
                                    {'id':'QRO', 'name':'Querétaro, México'},
                                    {'id':'REX', 'name':'Reynosa, México'},
                                    {'id':'SLP', 'name':'San Luis Potos, México'},
                                    {'id':'TAM', 'name':'Tampico, México'},
                                    {'id':'TAP', 'name':'Tapachula, México'},
                                    {'id':'TIJ', 'name':'Tijuana, México'},
                                    {'id':'TRC', 'name':'Torreón, México'},
                                    {'id':'TGZ', 'name':'Tuxtla Gutiérrez, México'},
                                    {'id':'VER', 'name':'Veracruz, México'},
                                    {'id':'VSA', 'name':'Villahermosa, México'},
                                    {'id':'ZCL', 'name':'Zacatecas, México'},
                                    {'id':'ZIH', 'name':'Zihuatanejo, México'},
                                    {'id':'BON', 'name':'Bonaire, Antillas Holandesas'},
                                    {'id':'BHI', 'name':'Bahía Blanca, Argentina'},
                                    {'id':'BUE', 'name':'Buenos Aires, Argentina'},
                                    {'id':'BUE', 'name':'Buenos Aires, Argentina'},
                                    {'id':'COR', 'name':'Córdoba, Argentina'},
                                    {'id':'CTC', 'name':'Catamarca, Argentina'},
                                    {'id':'CPC', 'name':'Chapelco, Argentina'},
                                    {'id':'CRD', 'name':'Comodoro Rivadavia, Argentina'},
                                    {'id':'CNQ', 'name':'Corrientes, Argentina'},
                                    {'id':'FTE', 'name':'El Calafate, Argentina'},
                                    {'id':'EQS', 'name':'Esquel, Argentina'},
                                    {'id':'FMA', 'name':'Formosa, Argentina'},
                                    {'id':'IGR', 'name':'Iguazú, Argentina'},
                                    {'id':'JUJ', 'name':'Jujuy, Argentina'},
                                    {'id':'IRJ', 'name':'La Rioja, Argentina'},
                                    {'id':'MDQ', 'name':'Mar del Plata, Argentina'},
                                    {'id':'MDZ', 'name':'Mendoza, Argentina'},
                                    {'id':'NQN', 'name':'Neuquen, Argentina'},
                                    {'id':'PSS', 'name':'Posadas, Argentina'},
                                    {'id':'RGL', 'name':'Río Gallegos, Argentina'},
                                    {'id':'RGA', 'name':'Río Grande, Argentina'},
                                    {'id':'RES', 'name':'Resistencia, Argentina'},
                                    {'id':'ROS', 'name':'Rosario, Argentina'},
                                    {'id':'SLA', 'name':'Salta, Argentina'},
                                    {'id':'BRC', 'name':'San Carlos de Bariloche, Argentina'},
                                    {'id':'UAQ', 'name':'San Juan, Argentina'},
                                    {'id':'LUQ', 'name':'San Luis, Argentina'},
                                    {'id':'AFA', 'name':'San Rafael, Argentina'},
                                    {'id':'SFN', 'name':'Santa Fe, Argentina'},
                                    {'id':'SDE', 'name':'Santiago del Estero, Argentina'},
                                    {'id':'REL', 'name':'Trelew, Argentina'},
                                    {'id':'TUC', 'name':'Tucum, Argentina'},
                                    {'id':'USH', 'name':'Ushuaia, Argentina'},
                                    {'id':'VDM', 'name':'Viedma, Argentina'},
                                    {'id':'AUA', 'name':'Aruba, Aruba'},
                                    {'id':'NAS', 'name':'Nassau, Bahamas'},
                                    {'id':'BZE', 'name':'Belice, Belice'},
                                    {'id':'BZE', 'name':'Belice, Belice'},
                                    {'id':'BDA', 'name':'Bermudas, Bermudas'},
                                    {'id':'CBB', 'name':'Cochabamba, Bolivia'},
                                    {'id':'LPB', 'name':'La Paz, Bolivia'},
                                    {'id':'SRE', 'name':'Sucre, Bolivia'},
                                    {'id':'TJA', 'name':'Tarija, Bolivia'},
                                    {'id':'ATM', 'name':'Altamira, Brasil'},
                                    {'id':'AJU', 'name':'Aracaju, Brasil'},
                                    {'id':'BEL', 'name':'Belem, Brasil'},
                                    {'id':'BHZ', 'name':'Belo Horizonte, Brasil'},
                                    {'id':'BHZ', 'name':'Belo Horizonte, Brasil'},
                                    {'id':'BSB', 'name':'Brasilia, Brasil'},
                                    {'id':'BZC', 'name':'Buzios, Brasil'},
                                    {'id':'CGR', 'name':'Campogrande, Brasil'},
                                    {'id':'IGU', 'name':'Cataratas de Iguazú, Brasil'},
                                    {'id':'CGB', 'name':'Cuiaba, Brasil'},
                                    {'id':'CWB', 'name':'Curitiba, Brasil'},
                                    {'id':'FLN', 'name':'Florianápolis, Brasil'},
                                    {'id':'FOR', 'name':'Fortaleza, Brasil'},
                                    {'id':'GYN', 'name':'Goiania, Brasil'},
                                    {'id':'JPA', 'name':'Joao Pessoa, Brasil'},
                                    {'id':'JOI', 'name':'Joinville, Brasil'},
                                    {'id':'LDB', 'name':'Londrina, Brasil'},
                                    {'id':'MCZ', 'name':'Maceio, Brasil'},
                                    {'id':'MAO', 'name':'Manaus, Brasil'},
                                    {'id':'MGF', 'name':'Maringa, Brasil'},
                                    {'id':'NAT', 'name':'Natal, Brasil'},
                                    {'id':'NVT', 'name':'Navegantes, Brasil'},
                                    {'id':'POA', 'name':'Porto Alegre, Brasil'},
                                    {'id':'RIO', 'name':'Río de Janeiro, Brasil'},
                                    {'id':'REC', 'name':'Recife, Brasil'},
                                    {'id':'SSA', 'name':'Salvador, Brasil'},
                                    {'id':'SAO', 'name':'San Pablo, Brasil'},
                                    {'id':'SLZ', 'name':'Sao Luiz, Brasil'},
                                    {'id':'THE', 'name':'Teresina, Brasil'},
                                    {'id':'VIX', 'name':'Vitoria, Brasil'},
                                    {'id':'ANF', 'name':'Antofagasta, Chile'},
                                    {'id':'ARI', 'name':'Arica, Chile'},
                                    {'id':'BBA', 'name':'Balmaceda, Chile'},
                                    {'id':'CJC', 'name':'Calama, Chile'},
                                    {'id':'CCP', 'name':'Concepción, Chile'},
                                    {'id':'CPO', 'name':'Copiapo, Chile'},
                                    {'id':'IQQ', 'name':'Iquique, Chile'},
                                    {'id':'PMC', 'name':'Puerto Montt, Chile'},
                                    {'id':'PUQ', 'name':'Punta Arenas, Chile'},
                                    {'id':'SCL', 'name':'Santiago, Chile'},
                                    {'id':'SCL', 'name':'Santiago, Chile'},
                                    {'id':'ZCO', 'name':'Temuco, Chile'},
                                    {'id':'ZAL', 'name':'Valdivia, Chile'},
                                    {'id':'AXM', 'name':'Armenia, Colombia'},
                                    {'id':'EJA', 'name':'Barrancabermeja, Colombia'},
                                    {'id':'BAQ', 'name':'Barranquilla, Colombia'},
                                    {'id':'BOG', 'name':'Bogot, Colombia'},
                                    {'id':'BGA', 'name':'Bucaramanga, Colombia'},
                                    {'id':'CLO', 'name':'Cali, Colombia'},
                                    {'id':'CTG', 'name':'Cartagena, Colombia'},
                                    {'id':'CUC', 'name':'Cucuta, Colombia'},
                                    {'id':'MDE', 'name':'Medell, Colombia'},
                                    {'id':'MDE', 'name':'Medell, Colombia'},
                                    {'id':'MTR', 'name':'Monter, Colombia'},
                                    {'id':'PSO', 'name':'Pasto, Colombia'},
                                    {'id':'PEI', 'name':'Pereira, Colombia'},
                                    {'id':'ADZ', 'name':'San Andr, Colombia'},
                                    {'id':'SMR', 'name':'Santa Marta, Colombia'},
                                    {'id':'SJO', 'name':'San Jos, Costa Rica'},
                                    {'id':'SJO', 'name':'San Jos, Costa Rica'},
                                    {'id':'CCC', 'name':'Cayo Coco, Cuba'},
                                    {'id':'HAV', 'name':'La Habana, Cuba'},
                                    {'id':'VRA', 'name':'Varadero, Cuba'},
                                    {'id':'GYE', 'name':'Guayaquil, Ecuador'},
                                    {'id':'UIO', 'name':'Quito, Ecuador'},
                                    {'id':'SAL', 'name':'San Salvador, El Salvador'},
                                    {'id':'GUA', 'name':'Guatemala, Guatemala'},
                                    {'id':'CAY', 'name':'Cayenne, Guyana Francesa'},
                                    {'id':'SAP', 'name':'San Pedro Sula, Honduras'},
                                    {'id':'KIN', 'name':'Kingston, Jamaica'},
                                    {'id':'KIN', 'name':'Kingston, Jamaica'},
                                    {'id':'MBJ', 'name':'Montego Bay, Jamaica'},
                                    {'id':'NEG', 'name':'Negril, Jamaica'},
                                    {'id':'MGA', 'name':'Managua, Nicaragua'},
                                    {'id':'PTY', 'name':'Panam, Panam'},
                                    {'id':'PTY', 'name':'Panam, Panam'},
                                    {'id':'ASU', 'name':'Asunción, Paraguay'},
                                    {'id':'AQP', 'name':'Arequipa, Perú'},
                                    {'id':'AYP', 'name':'Ayacucho, Perú'},
                                    {'id':'CIX', 'name':'Chiclayo, Perú'},
                                    {'id':'CUZ', 'name':'Cuzco, Perú'},
                                    {'id':'IQT', 'name':'Iquitos, Perú'},
                                    {'id':'JUL', 'name':'Juliaca, Perú'},
                                    {'id':'LIM', 'name':'Lima, Perú'},
                                    {'id':'PIU', 'name':'Piura, Perú'},
                                    {'id':'TCQ', 'name':'Tacna, Perú'},
                                    {'id':'TRU', 'name':'Trujillo, Perú'},
                                    {'id':'PUJ', 'name':'Punta Cana, República Dominicana'},
                                    {'id':'POS', 'name':'Puerto España, Trinidad y Tobago'},
                                    {'id':'TAB', 'name':'Tobago, Trinidad y Tobago'},
                                    {'id':'MVD', 'name':'Montevideo, Uruguay'},
                                    {'id':'BLA', 'name':'Barcelona, Venezuela'},
                                    {'id':'BLA', 'name':'Barcelona, Venezuela'},
                                    {'id':'CCS', 'name':'Caracas, Venezuela'},
                                    {'id':'VIG', 'name':'El Vig, Venezuela'},
                                    {'id':'MAR', 'name':'Maracaibo, Venezuela'},
                                    {'id':'MUN', 'name':'Maturin, Venezuela'},
                                    {'id':'PMV', 'name':'Porlamar, Venezuela'},
                                    {'id':'STD', 'name':'Santo Domingo, Venezuela'},
                                    {'id':'KBL', 'name':'Kabul, Afganist'},
                                    {'id':'DHA', 'name':'Dhahran, Arabia Saudita'},
                                    {'id':'JED', 'name':'Jeddah, Arabia Saudita'},
                                    {'id':'RUH', 'name':'Riyadh, Arabia Saudita'},
                                    {'id':'BAH', 'name':'Bahréin, Bahréin'},
                                    {'id':'BWN', 'name':'Bandar Seri Begawan, Brun'},
                                    {'id':'PNH', 'name':'Phnom Penh, Camboya'},
                                    {'id':'DLC', 'name':'Dalian, China'},
                                    {'id':'FOC', 'name':'Fuzhou, China'},
                                    {'id':'CAN', 'name':'Guangzhou, China'},
                                    {'id':'HKG', 'name':'Hong Kong, China'},
                                    {'id':'BJS', 'name':'Pek, China'},
                                    {'id':'SHA', 'name':'Shangai, China'},
                                    {'id':'SHA', 'name':'Shangai, China'},
                                    {'id':'WNZ', 'name':'Wenzhou, China'},
                                    {'id':'XMN', 'name':'Xiamen, China'},
                                    {'id':'PUS', 'name':'Busan, Corea, República de'},
                                    {'id':'SEL', 'name':'Seúl, Corea, República de'},
                                    {'id':'AUH', 'name':'Abu Dabi, Emiratos Árabes Unidos'},
                                    {'id':'DXB', 'name':'Dubai, Emiratos Árabes Unidos'},
                                    {'id':'ABA', 'name':'Abakan, Federación Rusa'},
                                    {'id':'DYR', 'name':'Anadyr, Federación Rusa'},
                                    {'id':'GDX', 'name':'Magadan, Federación Rusa'},
                                    {'id':'MOW', 'name':'Moscú, Federación Rusa'},
                                    {'id':'PEE', 'name':'Perm, Federación Rusa'},
                                    {'id':'KUF', 'name':'Samara, Federación Rusa'},
                                    {'id':'SGC', 'name':'Surgut, Federación Rusa'},
                                    {'id':'UFA', 'name':'Ufa Ru, Federación Rusa'},
                                    {'id':'MNL', 'name':'Manila, Filipinas'},
                                    {'id':'BLR', 'name':'Bangalore, India'},
                                    {'id':'IXC', 'name':'Chandigarh, India'},
                                    {'id':'MAA', 'name':'Chennai, India'},
                                    {'id':'DEL', 'name':'Delhi, India'},
                                    {'id':'HYD', 'name':'Hyderabad, India'},
                                    {'id':'BOM', 'name':'Mumbai, India'},
                                    {'id':'DPS', 'name':'Denpasar Bali, Indonesia'},
                                    {'id':'JKT', 'name':'Jakarta, Indonesia'},
                                    {'id':'JKT', 'name':'Jakarta, Indonesia'},
                                    {'id':'MES', 'name':'Medan, Indonesia'},
                                    {'id':'BSR', 'name':'Basra, Iraq'},
                                    {'id':'TLV', 'name':'Tel Aviv, Israel'},
                                    {'id':'TLV', 'name':'Tel Aviv, Israel'},
                                    {'id':'FUK', 'name':'Fukuoka, Japón'},
                                    {'id':'NGO', 'name':'Nagoya, Japón'},
                                    {'id':'NGO', 'name':'Nagoya, Japón'},
                                    {'id':'OSA', 'name':'Osaka, Japón'},
                                    {'id':'SPK', 'name':'Sapporo, Japón'},
                                    {'id':'SPK', 'name':'Sapporo, Japón'},
                                    {'id':'TYO', 'name':'Tokio, Japón'},
                                    {'id':'AMM', 'name':'Amm, Jordania'},
                                    {'id':'AMM', 'name':'Amm, Jordania'},
                                    {'id':'FRU', 'name':'Bishkek, Kirguist'},
                                    {'id':'KWI', 'name':'Kuwait, Kuwait'},
                                    {'id':'BEY', 'name':'Beirut, Líbano'},
                                    {'id':'KUL', 'name':'Kuala Lumpur, Malasia'},
                                    {'id':'MLE', 'name':'Male, Maldivas'},
                                    {'id':'ULN', 'name':'Ulan Bator, Mongolia'},
                                    {'id':'MCT', 'name':'Muscat, Omán, Sultanato de'},
                                    {'id':'ISB', 'name':'Islamabad, Pakist'},
                                    {'id':'KHI', 'name':'Karachi, Pakist'},
                                    {'id':'DOH', 'name':'Doha, Qatar'},
                                    {'id':'ALP', 'name':'Aleppo, República Árabe Siria'},
                                    {'id':'DAM', 'name':'Damasco, República Árabe Siria'},
                                    {'id':'SIN', 'name':'Singapur, Singapur'},
                                    {'id':'CMB', 'name':'Colombo, Sri Lanka'},
                                    {'id':'BKK', 'name':'Bangkok, Tailandia'},
                                    {'id':'ANK', 'name':'Ankara, Turqu'},
                                    {'id':'ANK', 'name':'Ankara, Turqu'},
                                    {'id':'IST', 'name':'Estambul, Turqu'},
                                    {'id':'HAN', 'name':'Hanoi, Vietnam'},
                                    {'id':'SGN', 'name':'Ho Chi Minh, Vietnam'},
                                    {'id':'ADE', 'name':'Aden, Yemen, República de'},
                                    {'id':'SAH', 'name':'Sanaa, Yemen, República de'},
                                    {'id':'BER', 'name':'Berl, Alemania'},
                                    {'id':'BER', 'name':'Berl, Alemania'},
                                    {'id':'CGN', 'name':'Colonia, Alemania'},
                                    {'id':'DRS', 'name':'Dresde, Alemania'},
                                    {'id':'DUS', 'name':'Dusseldorf, Alemania'},
                                    {'id':'DUS', 'name':'Dusseldorf, Alemania'},
                                    {'id':'DUS', 'name':'Dusseldorf, Alemania'},
                                    {'id':'FRA', 'name':'Frankfurt, Alemania'},
                                    {'id':'FRA', 'name':'Frankfurt, Alemania'},
                                    {'id':'HAM', 'name':'Hamburgo, Alemania'},
                                    {'id':'HAJ', 'name':'Hanover, Alemania'},
                                    {'id':'GRZ', 'name':'Graz, Austria'},
                                    {'id':'BRU', 'name':'Bruselas, Bélgica'},
                                    {'id':'SOF', 'name':'Sof, Bulgaria'},
                                    {'id':'ZAG', 'name':'Zagreb, Croacia'},
                                    {'id':'CPH', 'name':'Copenhague, Dinamarca'},
                                    {'id':'ALC', 'name':'Alicante, España'},
                                    {'id':'LEI', 'name':'Almer, España'},
                                    {'id':'OVD', 'name':'Asturias, España'},
                                    {'id':'BCN', 'name':'Barcelona, España'},
                                    {'id':'BIO', 'name':'Bilbao, España'},
                                    {'id':'ODB', 'name':'Córdoba, España'},
                                    {'id':'LPA', 'name':'Gran Canaria, España'},
                                    {'id':'GRX', 'name':'Granada, España'},
                                    {'id':'IBZ', 'name':'Ibiza, España'},
                                    {'id':'LCG', 'name':'La Coruña, España'},
                                    {'id':'ACE', 'name':'Lanzarote, España'},
                                    {'id':'LEN', 'name':'León, España'},
                                    {'id':'AGP', 'name':'Málaga, España'},
                                    {'id':'MAD', 'name':'Madrid, España'},
                                    {'id':'MAH', 'name':'Menorca, España'},
                                    {'id':'MJV', 'name':'Murcia, España'},
                                    {'id':'PMI', 'name':'Palma de Mallorca, España'},
                                    {'id':'PNA', 'name':'Pamplona, España'},
                                    {'id':'FUE', 'name':'Puerto del Rosario, España'},
                                    {'id':'SLM', 'name':'Salamanca, España'},
                                    {'id':'EAS', 'name':'San Sebasti, España'},
                                    {'id':'SCQ', 'name':'Santiago de Compostela, España'},
                                    {'id':'SVQ', 'name':'Sevilla, España'},
                                    {'id':'TCI', 'name':'Tenerife, España'},
                                    {'id':'TCI', 'name':'Tenerife, España'},
                                    {'id':'VLC', 'name':'Valencia, España'},
                                    {'id':'VGO', 'name':'Vigo, España'},
                                    {'id':'ZAZ', 'name':'Zaragoza, España'},
                                    {'id':'HEL', 'name':'Helsinki, Finlandia'},
                                    {'id':'LYS', 'name':'Lyon, Francia'},
                                    {'id':'PAR', 'name':'París, Francia'},
                                    {'id':'PAR', 'name':'París, Francia'},
                                    {'id':'PAR', 'name':'París, Francia'},
                                    {'id':'PAR', 'name':'París, Francia'},
                                    {'id':'TLS', 'name':'Toulouse, Francia'},
                                    {'id':'GIB', 'name':'Gibraltar, Gibraltar'},
                                    {'id':'ATH', 'name':'Atenas, Grecia'},
                                    {'id':'BUD', 'name':'Budapest, Hungr'},
                                    {'id':'DUB', 'name':'Dubl, Irlanda, República de'},
                                    {'id':'AHO', 'name':'Alghero, Italia'},
                                    {'id':'AOI', 'name':'Ancona, Italia'},
                                    {'id':'BRI', 'name':'Bari, Italia'},
                                    {'id':'BLQ', 'name':'Bolonia, Italia'},
                                    {'id':'BDS', 'name':'Brindisi, Italia'},
                                    {'id':'CAG', 'name':'Cagliari, Italia'},
                                    {'id':'CTA', 'name':'Catania, Italia'},
                                    {'id':'CRV', 'name':'Crotone, Italia'},
                                    {'id':'FLR', 'name':'Florencia, Italia'},
                                    {'id':'GOA', 'name':'Génova, Italia'},
                                    {'id':'SUF', 'name':'Lamezia Terme, Italia'},
                                    {'id':'MIL', 'name':'Mil, Italia'},
                                    {'id':'MIL', 'name':'Mil, Italia'},
                                    {'id':'MIL', 'name':'Mil, Italia'},
                                    {'id':'NAP', 'name':'Nápoles, Italia'},
                                    {'id':'PMO', 'name':'Palermo, Italia'},
                                    {'id':'PMO', 'name':'Palermo, Italia'},
                                    {'id':'PSA', 'name':'Pisa, Italia'},
                                    {'id':'REG', 'name':'Reggio Calabria, Italia'},
                                    {'id':'ROM', 'name':'Roma, Italia'},
                                    {'id':'TRS', 'name':'Trieste, Italia'},
                                    {'id':'TRN', 'name':'Tur, Italia'},
                                    {'id':'VCE', 'name':'Venecia, Italia'},
                                    {'id':'VCE', 'name':'Venecia, Italia'},
                                    {'id':'VRN', 'name':'Verona, Italia'},
                                    {'id':'VRN', 'name':'Verona, Italia'},
                                    {'id':'LUX', 'name':'Luxemburgo, Luxemburgo'},
                                    {'id':'MLA', 'name':'Malta, Malta'},
                                    {'id':'AES', 'name':'Aalesund, Noruega'},
                                    {'id':'BGO', 'name':'Bergen, Noruega'},
                                    {'id':'OSL', 'name':'Oslo, Noruega'},
                                    {'id':'OSL', 'name':'Oslo, Noruega'},
                                    {'id':'OSL', 'name':'Oslo, Noruega'},
                                    {'id':'AMS', 'name':'Ámsterdam, Países Bajos'},
                                    {'id':'WAW', 'name':'Varsovia, Polonia'},
                                    {'id':'FAO', 'name':'Faro, Portugal'},
                                    {'id':'FNC', 'name':'Funchal, Portugal'},
                                    {'id':'LIS', 'name':'Lisboa, Portugal'},
                                    {'id':'OPO', 'name':'Oporto, Portugal'},
                                    {'id':'ABZ', 'name':'Aberdeen, Reino Unido'},
                                    {'id':'BFS', 'name':'Belfast, Reino Unido'},
                                    {'id':'EDI', 'name':'Edimburgo, Reino Unido'},
                                    {'id':'GLA', 'name':'Glasgow, Reino Unido'},
                                    {'id':'GLA', 'name':'Glasgow, Reino Unido'},
                                    {'id':'LON', 'name':'Londres, Reino Unido'},
                                    {'id':'LON', 'name':'Londres, Reino Unido'},
                                    {'id':'LON', 'name':'Londres, Reino Unido'},
                                    {'id':'LON', 'name':'Londres, Reino Unido'},
                                    {'id':'MAN', 'name':'Manchester, Reino Unido'},
                                    {'id':'PRG', 'name':'Praga, República Checa'},
                                    {'id':'BUH', 'name':'Bucarest, Ruman'},
                                    {'id':'STO', 'name':'Estocolmo, Suecia'},
                                    {'id':'STO', 'name':'Estocolmo, Suecia'},
                                    {'id':'STO', 'name':'Estocolmo, Suecia'},
                                    {'id':'STO', 'name':'Estocolmo, Suecia'},
                                    {'id':'GOT', 'name':'Gotemburgo, Suecia'},
                                    {'id':'BSL', 'name':'Basilea, Suiza'},
                                    {'id':'BRN', 'name':'Berna, Suiza'},
                                    {'id':'GVA', 'name':'Ginebra, Suiza'},
                                    {'id':'ZRH', 'name':'Zurich, Suiza'},
                                    {'id':'IEV', 'name':'Kiev, Ucrania'},
                                    {'id':'IEV', 'name':'Kiev, Ucrania'},
                                    {'id':'ADL', 'name':'Adelaida, Australia'},
                                    {'id':'ABX', 'name':'Albury, Australia'},
                                    {'id':'ASP', 'name':'Alice Springs, Australia'},
                                    {'id':'ARM', 'name':'Armidale, Australia'},
                                    {'id':'AYQ', 'name':'Ayers Rock, Australia'},
                                    {'id':'BNK', 'name':'Ballina, Australia'},
                                    {'id':'BCI', 'name':'Barcaldine, Australia'},
                                    {'id':'ZBL', 'name':'Biloela, Australia'},
                                    {'id':'BKQ', 'name':'Blackall, Australia'},
                                    {'id':'BLT', 'name':'Blackwater, Australia'},
                                    {'id':'BNE', 'name':'Brisbane, Australia'},
                                    {'id':'BME', 'name':'Broome, Australia'},
                                    {'id':'BDB', 'name':'Bundaberg, Australia'},
                                    {'id':'CNS', 'name':'Cairns, Australia'},
                                    {'id':'CBR', 'name':'Canberra, Australia'},
                                    {'id':'CTL', 'name':'Charleville, Australia'},
                                    {'id':'CNJ', 'name':'Cloncurry, Australia'},
                                    {'id':'CFS', 'name':'Coffs Harbour, Australia'},
                                    {'id':'DRW', 'name':'Darwin, Australia'},
                                    {'id':'DPO', 'name':'Devonport, Australia'},
                                    {'id':'DBO', 'name':'Dubbo, Australia'},
                                    {'id':'EMD', 'name':'Emerald, Australia'},
                                    {'id':'GET', 'name':'Geraldton, Australia'},
                                    {'id':'GLT', 'name':'Gladstone, Australia'},
                                    {'id':'OOL', 'name':'Gold Coast, Australia'},
                                    {'id':'GOV', 'name':'Gove, Australia'},
                                    {'id':'HVB', 'name':'Hervey Bay, Australia'},
                                    {'id':'HBA', 'name':'Hobart, Australia'},
                                    {'id':'HTI', 'name':'Isla Hamilton, Australia'},
                                    {'id':'HID', 'name':'Isla Horn, Australia'},
                                    {'id':'LDH', 'name':'Isla Lord Howe, Australia'},
                                    {'id':'KGI', 'name':'Kalgoorlie, Australia'},
                                    {'id':'KTA', 'name':'Karratha, Australia'},
                                    {'id':'KNX', 'name':'Kununurra, Australia'},
                                    {'id':'LST', 'name':'Launceston, Australia'},
                                    {'id':'LEA', 'name':'Learmonth, Australia'},
                                    {'id':'LRE', 'name':'Longreach, Australia'},
                                    {'id':'MKY', 'name':'Mackay, Australia'},
                                    {'id':'MCY', 'name':'Maroochydore, Australia'},
                                    {'id':'MEL', 'name':'Melbourne, Australia'},
                                    {'id':'MEL', 'name':'Melbourne, Australia'},
                                    {'id':'MEL', 'name':'Melbourne, Australia'},
                                    {'id':'MQL', 'name':'Mildura, Australia'},
                                    {'id':'MOV', 'name':'Moranbah, Australia'},
                                    {'id':'MRZ', 'name':'Moree, Australia'},
                                    {'id':'ISA', 'name':'Mount Isa, Australia'},
                                    {'id':'NAA', 'name':'Narrabri, Australia'},
                                    {'id':'NTL', 'name':'Newcastle, Australia'},
                                    {'id':'NTL', 'name':'Newcastle, Australia'},
                                    {'id':'ZNE', 'name':'Newman, Australia'},
                                    {'id':'OLP', 'name':'Olympic Dam, Australia'},
                                    {'id':'PBO', 'name':'Paraburdoo, Australia'},
                                    {'id':'PER', 'name':'Perth, Australia'},
                                    {'id':'PHE', 'name':'Port Hedland, Australia'},
                                    {'id':'PLO', 'name':'Port Lincoln, Australia'},
                                    {'id':'PPP', 'name':'Proserpine, Australia'},
                                    {'id':'PQQ', 'name':'Pt Macquarie, Australia'},
                                    {'id':'UEE', 'name':'Queenstown, Australia'},
                                    {'id':'ROK', 'name':'Rockhampton, Australia'},
                                    {'id':'RMA', 'name':'Roma, Australia'},
                                    {'id':'SYD', 'name':'Sidney (New South Wales), Australia'},
                                    {'id':'SYD', 'name':'Sidney (New South Wales), Australia'},
                                    {'id':'SYD', 'name':'Sidney (New South Wales), Australia'},
                                    {'id':'TMW', 'name':'Tamworth, Australia'},
                                    {'id':'TSV', 'name':'Townsville, Australia'},
                                    {'id':'WGA', 'name':'Wagga Wagga, Australia'},
                                    {'id':'WEI', 'name':'Weipa, Australia'},
                                    {'id':'NLK', 'name':'Isla Norfolk, Isla Norfolk'},
                                    {'id':'NAN', 'name':'Nadi, Islas Fiji'},
                                    {'id':'SUV', 'name':'Suva, Islas Fiji'},
                                    {'id':'NOU', 'name':'Noumea, Nueva Caledonia'},
                                    {'id':'NOU', 'name':'Noumea, Nueva Caledonia'},
                                    {'id':'AKL', 'name':'Auckland, Nueva Zelanda'},
                                    {'id':'BHE', 'name':'Blenheim, Nueva Zelanda'},
                                    {'id':'CHC', 'name':'Christchurch, Nueva Zelanda'},
                                    {'id':'DUD', 'name':'Dunedin, Nueva Zelanda'},
                                    {'id':'GIS', 'name':'Gisborne, Nueva Zelanda'},
                                    {'id':'HLZ', 'name':'Hamilton, Nueva Zelanda'},
                                    {'id':'IVC', 'name':'Invercargill, Nueva Zelanda'},
                                    {'id':'KKE', 'name':'Kerikeri, Nueva Zelanda'},
                                    {'id':'NPE', 'name':'Napier Hastings, Nueva Zelanda'},
                                    {'id':'NSN', 'name':'Nelson, Nueva Zelanda'},
                                    {'id':'NPL', 'name':'Nuevo Plymouth, Nueva Zelanda'},
                                    {'id':'PMR', 'name':'Palmerston, Nueva Zelanda'},
                                    {'id':'ROT', 'name':'Rotorua, Nueva Zelanda'},
                                    {'id':'WAG', 'name':'Wanganui, Nueva Zelanda'},
                                    {'id':'WLG', 'name':'Wellington, Nueva Zelanda'},
                                    {'id':'WHK', 'name':'Whakatane, Nueva Zelanda'},
                                    {'id':'APW', 'name':'Apia, Samoa, Estado Independiente de'},
                                    {'id':'APW', 'name':'Apia, Samoa, Estado Independiente de'},
                                    {'id':'VLI', 'name':'Port Vila, Vanuatu'},
                                    {'id':'ARR', 'name':'Alto Río Senguerr, Argentina'},
                                    {'id':'CCT', 'name':'Colonial Catriel, Argentina'},
                                    {'id':'COC', 'name':'Concordia, Argentina'},
                                    {'id':'CUT', 'name':'Cutral Co, Argentina'},
                                    {'id':'EHL', 'name':'El Bolsón, Argentina'},
                                    {'id':'EMX', 'name':'El Mait, Argentina'},
                                    {'id':'GPO', 'name':'General Pico, Argentina'},
                                    {'id':'GNR', 'name':'General Roca, Argentina'},
                                    {'id':'GGS', 'name':'Gobernador Gregores, Argentina'},
                                    {'id':'JSM', 'name':'José de San Martí, Argentina'},
                                    {'id':'LPG', 'name':'La Plata, Argentina'},
                                    {'id':'ING', 'name':'Lago Argentino, Argentina'},
                                    {'id':'NEC', 'name':'Necochea, Argentina'},
                                    {'id':'PRA', 'name':'Paraná, Argentina'},
                                    {'id':'AOL', 'name':'Paso de los Libres, Argentina'},
                                    {'id':'PMQ', 'name':'Perito Moreno, Argentina'},
                                    {'id':'PUD', 'name':'Puerto Deseado, Argentina'},
                                    {'id':'PMY', 'name':'Puerto Madryn, Argentina'},
                                    {'id':'RCU', 'name':'Río Cuarto, Argentina'},
                                    {'id':'ROY', 'name':'Río Mayo, Argentina'},
                                    {'id':'RYO', 'name':'Río Turbio, Argentina'},
                                    {'id':'RCQ', 'name':'Reconquista, Argentina'},
                                    {'id':'OES', 'name':'San Antonio Oeste, Argentina'},
                                    {'id':'ULA', 'name':'San Juli, Argentina'},
                                    {'id':'RZA', 'name':'Santa Cruz, Argentina'},
                                    {'id':'RSA', 'name':'Santa Rosa, Argentina'},
                                    {'id':'SGV', 'name':'Sierra Grande, Argentina'},
                                    {'id':'TDL', 'name':'Tandil, Argentina'},
                                    {'id':'OYO', 'name':'Tres Arroyos, Argentina'},
                                    {'id':'VLG', 'name':'Villa Gesell, Argentina'},
                                    {'id':'VME', 'name':'Villa Mercedes, Argentina'},
                                    {'id':'APZ', 'name':'Zapala, Argentina'}
                                    ];

            $scope.nationalities = [];
            $scope.residences = [];
                            
            $scope.countries = [{'id':'AO', 'name':'Angola'}, {'id':'AD', 'name':'Andorra'}, {'id':'AE', 'name':'Emiratos Árabes Unidos'}, {'id':'AG', 'name':'Antigua y Barbuda'}, {'id':'AI', 'name':'Anguila'}, {'id':'AL', 'name':'Albania'}, {'id':'AM', 'name':'Armenia'}, {'id':'AN', 'name':'Antillas Holandesas'}, {'id':'AO', 'name':'Angola'}, {'id':'AR', 'name':'Argentina'}, {'id':'AS', 'name':'Samoa Americana'}, {'id':'AT', 'name':'Austria'}, {'id':'AU', 'name':'Australia'}, {'id':'AZ', 'name':'Azerbaiy'}, {'id':'BA', 'name':'Bosnia y Herzegovina'}, {'id':'BB', 'name':'Barbados'}, {'id':'BD', 'name':'Bangladesh'}, {'id':'BE', 'name':'Bélgica'}, {'id':'BF', 'name':'Burkina Faso'}, {'id':'BG', 'name':'Bulgaria'}, {'id':'BN', 'name':'Brun'}, {'id':'BO', 'name':'Bolivia'}, {'id':'BR', 'name':'Brasil'}, {'id':'BS', 'name':'Bahamas'}, {'id':'BT', 'name':'Bhut'}, {'id':'BV', 'name':'Isla Bouvet'}, {'id':'BW', 'name':'Botsuana'}, {'id':'BY', 'name':'Bielorrusia'}, {'id':'BZ', 'name':'Belice'}, {'id':'CA', 'name':'Canadá'}, {'id':'CC', 'name':'Islas Cocos'}, {'id':'CD', 'name':'Congo, Rep?blica Democr?tica de'}, {'id':'CF', 'name':'República Centroafricana'}, {'id':'CG', 'name':'Congo'}, {'id':'CH', 'name':'Suiza'}, {'id':'CI', 'name':'Costa de Marfil'}, {'id':'CK', 'name':'Islas Cook'}, {'id':'CL', 'name':'Chile'}, {'id':'CM', 'name':'República de Camerún'}, {'id':'CN', 'name':'China'}, {'id':'CO', 'name':'Colombia'}, {'id':'CR', 'name':'Costa Rica'}, {'id':'CU', 'name':'Cuba'}, {'id':'CV', 'name':'República de Cabo Verde'}, {'id':'CX', 'name':'Isla Christmas'}, {'id':'CY', 'name':'Chipre'}, {'id':'CZ', 'name':'República Checa'}, {'id':'DE', 'name':'Alemania'}, {'id':'DJ', 'name':'Yibuti'}, {'id':'DK', 'name':'Dinamarca'}, {'id':'DM', 'name':'Dominica'}, {'id':'DO', 'name':'República Dominicana'}, {'id':'DZ', 'name':'Argelia'}, {'id':'EC', 'name':'Ecuador'}, {'id':'EE', 'name':'Estonia'}, {'id':'EG', 'name':'Egipto'}, {'id':'EH', 'name':'Sahara Occidental'}, {'id':'ER', 'name':'Eritrea'}, {'id':'ES', 'name':'España'}, {'id':'ET', 'name':'Etiop'}, {'id':'FI', 'name':'Finlandia'}, {'id':'FJ', 'name':'Islas Fiji'}, {'id':'FK', 'name':'Islas Malvinas'}, {'id':'FM', 'name':'Micronesia'}, {'id':'FO', 'name':'Islas Feroe'}, {'id':'FR', 'name':'Francia'}, {'id':'GA', 'name':'Gab?n'}, {'id':'GB', 'name':'Reino Unido'}, {'id':'GD', 'name':'Granada'}, {'id':'GE', 'name':'Georgia'}, {'id':'GF', 'name':'Guyana Francesa'}, {'id':'GH', 'name':'Ghana'}, {'id':'GL', 'name':'Groenlandia'}, {'id':'GM', 'name':'Gambia'}, {'id':'GP', 'name':'Guadalupe'}, {'id':'GR', 'name':'Grecia'}, {'id':'GT', 'name':'Guatemala'}, {'id':'GU', 'name':'Guam'}, {'id':'GY', 'name':'Guyana'}, {'id':'HK', 'name':'Hong Kong'}, {'id':'HN', 'name':'Honduras'}, {'id':'HR', 'name':'Croacia'}, {'id':'HT', 'name':'Haití'}, {'id':'HU', 'name':'Hungr'}, {'id':'ID', 'name':'Indonesia'}, {'id':'IE', 'name':'República de Irlanda'}, {'id':'IL', 'name':'Israel'}, {'id':'IN', 'name':'India'}, {'id':'IQ', 'name':'Iraq'}, {'id':'IR', 'name':'Irák'}, {'id':'IS', 'name':'Islandia'}, {'id':'IT', 'name':'Italia'}, {'id':'JM', 'name':'Jamaica'}, {'id':'JO', 'name':'Jordania'}, {'id':'JP', 'name':'Japón'}, {'id':'KE', 'name':'Kenia'}, {'id':'KH', 'name':'Camboya'}, {'id':'KI', 'name':'Kiribati'}, {'id':'KM', 'name':'Comoras'}, {'id':'KN', 'name':'San Cristóbal y Nieves'}, {'id':'KP', 'name':'Corea del Sur'}, {'id':'KR', 'name':'Corea del Norte'}, {'id':'KY', 'name':'Islas Caim'}, {'id':'KZ', 'name':'Kazajstán'}, {'id':'LA', 'name':'República Popular Democrática de Laos'}, {'id':'LB', 'name':'Líbano'}, {'id':'LC', 'name':'Santa Lucía'}, {'id':'LI', 'name':'Liechtenstein'}, {'id':'LK', 'name':'Sri Lanka'}, {'id':'LR', 'name':'Liberia'}, {'id':'LS', 'name':'Lesotho'}, {'id':'LT', 'name':'Lituania'}, {'id':'LV', 'name':'Letonia'}, {'id':'LY', 'name':'Yamahiriya Árabe Libia'}, {'id':'MA', 'name':'Marruecos'}, {'id':'MC', 'name':'Mónaco'}, {'id':'MD', 'name':'Moldavia'}, {'id':'MG', 'name':'Madagascar'}, {'id':'MH', 'name':'Islas Marshall'}, {'id':'MK', 'name':'Macedonia'}, {'id':'ML', 'name':'Mal'}, {'id':'MM', 'name':'Myanmar'}, {'id':'MO', 'name':'Macao'}, {'id':'MP', 'name':'Islas Marianas'}, {'id':'MQ', 'name':'Martinica'}, {'id':'MR', 'name':'Mauritania'}, {'id':'MS', 'name':'Montserrat'}, {'id':'MT', 'name':'Malta'}, {'id':'MU', 'name':'Mauricio'}, {'id':'MW', 'name':'Malawi'}, {'id':'MX', 'name':'México'}, {'id':'MY', 'name':'Malasia'}, {'id':'MZ', 'name':'Mozambique'}, {'id':'NA', 'name':'Namibia'}, {'id':'NC', 'name':'Nueva Caledonia'}, {'id':'NG', 'name':'Nigeria'}, {'id':'NL', 'name':'Países Bajos'}, {'id':'NO', 'name':'Noruega'}, {'id':'NP', 'name':'Nepal'}, {'id':'NR', 'name':'Nauru'}, {'id':'NU', 'name':'Niue'}, {'id':'NZ', 'name':'Nueva Zelanda'}, {'id':'OM', 'name':'Sultanato de Omán'}, {'id':'PA', 'name':'Panam'}, {'id':'PE', 'name':'Perú'}, {'id':'PF', 'name':'Polinesia Francesa'}, {'id':'PG', 'name':'Pap?a Nueva Guinea (Niugini)'}, {'id':'PH', 'name':'Filipinas'}, {'id':'PK', 'name':'Pakist'}, {'id':'PL', 'name':'Polonia'}, {'id':'PM', 'name':'San Pedro y Miquelón'}, {'id':'PS', 'name':'Territorio ocupado de Palestina'}, {'id':'PT', 'name':'Portugal'}, {'id':'PW', 'name':'Palaos'}, {'id':'PY', 'name':'Paraguay'}, {'id':'RE', 'name':'Reunión'}, {'id':'RO', 'name':'Ruman'}, {'id':'RU', 'name':'Rusia'}, {'id':'RW', 'name':'Ruanda'}, {'id':'SA', 'name':'Arabia Saudita'}, {'id':'SB', 'name':'Islas Salomón'}, {'id':'SC', 'name':'Islas Seychelles'}, {'id':'SD', 'name':'Sudán'}, {'id':'SE', 'name':'Suecia'}, {'id':'SH', 'name':'Isla Ascensión/Sta. Elena'}, {'id':'SI', 'name':'Eslovenia'}, {'id':'SJ', 'name':'Islas Svalbard y Jan Mayen'}, {'id':'SK', 'name':'Eslovaquia'}, {'id':'SL', 'name':'Sierra Leona'}, {'id':'SM', 'name':'San Marino'}, {'id':'SN', 'name':'Senegal'}, {'id':'SO', 'name':'Somalia'}, {'id':'SR', 'name':'Surinam'}, {'id':'ST', 'name':'Santo Tomé y Príncipe'}, {'id':'SY', 'name':'República Árabe Siria'}, {'id':'SZ', 'name':'Suazilandia'}, {'id':'TC', 'name':'Islas Turcos y Caicos'}, {'id':'TD', 'name':'Chad'}, {'id':'TG', 'name':'Togo'}, {'id':'TH', 'name':'Tailandia'}, {'id':'TJ', 'name':'Tayikist'}, {'id':'TM', 'name':'Turkmenist'}, {'id':'TN', 'name':'Túnez'}, {'id':'TO', 'name':'Tonga'}, {'id':'TR', 'name':'Turquía'}, {'id':'TV', 'name':'Tuvalu'}, {'id':'TW', 'name':'Taiwán'}, {'id':'TZ', 'name':'Tanzania'}, {'id':'UA', 'name':'Ucrania'}, {'id':'UG', 'name':'Uganda'}, {'id':'UM', 'name':'Islas menores alejadas de los Estados Unidos'}, {'id':'US', 'name':'Estados Unidos'}, {'id':'UZ', 'name':'Sum de Uzbekist'}, {'id':'VA', 'name':'Estado de la Ciudad del Vaticano'}, {'id':'VC', 'name':'San Vicente y las Granadinas'}, {'id':'VG', 'name':'Islas Vírgenes Británicas'}, {'id':'VN', 'name':'Vietnam'}, {'id':'VU', 'name':'Vanuatu'}, {'id':'WF', 'name':'Islas Wallis y Futuna'}, {'id':'WS', 'name':'Samoa, Estado Independiente de'}, {'id':'YE', 'name':'República de Yemen'}, {'id':'YT', 'name':'Mayotte'}, {'id':'YU', 'name':'Yugoslavia'}, {'id':'ZA', 'name':'Sudáfrica'}, {'id':'ZM', 'name':'Zambia'}, {'id':'ZW', 'name':'Zimbabue'}];
            $scope.months = [{'id':1,  'name':'Enero'},{'id':2,  'name':'Febrero'},{'id':3,  'name':'Marzo'},{'id':4,  'name':'Abril'},{'id':5,  'name':'Mayo'},{'id':6,  'name':'Junio'},{'id':7,  'name':'Julio'},{'id':8,  'name':'Agosto'},{'id':9,  'name':'Septiembre'},{'id':10, 'name':'Octubre'},{'id':11, 'name':'Noviembre'},{'id':12, 'name':'Diciembre'}];
            $scope.years = [(new Date()).getFullYear(), parseInt((new Date()).getFullYear()) + 1, parseInt((new Date()).getFullYear()) + 2] ;

            $scope.$watch('origin_place_name', function(new_value, old_value){
                  if(new_value != null && new_value.length > 3){
                      for(i = 0;i < $scope.origins_place.length;i++){
                          if($scope.origins_place[i].name == new_value){
                              $scope.params.origin_place = $scope.origins_place[i].id;
                              break;
                          }
                      }
                  }
            });

            $scope.$watch('destination_place_name', function(new_value, old_value){
                  if(new_value != null && new_value.length > 3){
                      for(i = 0;i < $scope.destinations_place.length;i++){
                          if($scope.destinations_place[i].name == new_value){
                              $scope.params.destination_place = $scope.destinations_place[i].id;
                              break;
                          }
                      }
                  }
            });

            $scope.$watch('month_departure_name', function(new_value, old_value){
                  if(new_value != null && new_value.length > 3){
                      for(i = 0;i < $scope.months.length;i++){
                          if($scope.months[i].name == new_value){
                              $scope.params.month_departure = $scope.months[i].id;
                              break;
                          }
                      }
                  }
            });

            $scope.$watch('rooms', function(new_value, old_value){
                  $scope.rooms = parseInt($scope.rooms);
                  rooms_length = $scope.params.Room.length;

                  if($scope.rooms > rooms_length){
                        for(i = $scope.params.Room.length;i < $scope.rooms;i++){
                              $scope.params.Room.push({"adult":2,"Children":[]});
                        }
                  } else {
                        for(i = $scope.rooms; i < rooms_length;i++){
                              $scope.params.Room.pop();
                        }
                  }

                  for(i = 0;i < $scope.params.Room.length;i++){
                        for(j = 0;j < $scope.params.Room[i].adult;j++){
                              $scope.Booking.Passenger.push({"name":"","surname":"","kind_doc":"","num_doc":"","gender":"","birthdate":"","residence":"","nationality":"","mail":""});
                        }

                        for(j = 0;j < $scope.params.Room[i].Children.length;j++){
                              $scope.Booking.Passenger.push({"name":"","surname":"","kind_doc":"","num_doc":"","gender":"","birthdate":"","residence":"","nationality":"","mail":""});
                        }                        
                  }
            });

            $scope.number_nights = function (package){
                  var number_nights = 0;
                  for(i = 0;i < package.Place.length;i++){
                        number_nights += package.Place[i].number_nights;
                  }

                  if(number_nights == 1){
                        return number_nights + " noche";
                  } else {
                        return number_nights + " noches";
                  }
            }
        
            $scope.changeRoom = function (room, children){
                  children = parseInt(children);
                  children_length = room.Children.length;

                  if(children > children_length){
                        for(i = room.Children.length;i < children;i++){
                              room.Children.push({"age":2});
                        }
                  } else {
                        for(i = children; i < children_length;i++){
                             room.Children.pop();
                        }
                  }
            }

            $scope.currency = function (currency){
                  switch(currency){
                        case 'ARS' :{return '$';};
                        case 'USD' :{return 'U$D';};
                        case 'EUR' :{return '€';};
                  }
            }

            $scope.getPackageList = function () {
                  $http
                    .post("getPackageList.php", $scope.params)
                    .success(function(data, status, headers, config) {
                        $scope.response = data;
                        target_offset = $('#package-result').offset(),
                        target_top = target_offset.top - 100;
                        $('html, body').animate({
                            scrollTop: target_top
                        });
                    }).error(function(data, status, headers, config) {
                        swal('Lo sentimos!', 'El request no pudo ser procesado.', 'error');
                  });
            }

            $scope.getPackage = function (id) {
                  $http
                    .get("getPackage.php?id=" + id)
                    .success(function(data, status, headers, config) {
                        $scope.selected_package = data;
                        $scope.Booking.package_fare_id = id;
                        target_offset = $('#package-view').offset(),
                        target_top = target_offset.top - 100;
                        $('html, body').animate({
                            scrollTop: target_top
                        });
                     

                    }).error(function(data, status, headers, config) {
                        swal('Lo sentimos!', 'El request no pudo ser procesado.', 'error');
                  });
            }

            $scope.checkAvail = function (id){
                  $http
                    .get("checkAvail.php?id=" + id)
                    .success(function(data, status, headers, config) {
                        $scope.checked_package = data;
                        if(data.status == "AVAILABLE"){
                              swal({   
                                    title: "Paquete disponible!",   
                                    text: '<pre>' + JSON.stringify($scope.checked_package, undefined, 1) + '</pre>',   
                                    customClass: 'sweet-big',
                                    type: "success",   
                                    html:true
                              });
                        } else {
                              swal({   
                                    title: "Paquete no disponible!",   
                                    text: '<pre>' + JSON.stringify($scope.checked_package, undefined, 1) + '</pre>',   
                                    customClass: 'sweet-big',
                                    type: "error",   
                                    html:true
                              });
                        }
                    }).error(function(data, status, headers, config) {
                        swal('Lo sentimos!', 'El request no pudo ser procesado.', 'error');
                  });
            }

            $scope.bookingPackage = function (){
                  var _data = {"package_fare_id":$scope.Booking.package_fare_id, "Passenger":[]}
                  for(i = 0;i < $scope.Booking.Passenger.length;i++){
                        _data.Passenger.push({"name":$scope.Booking.Passenger[i].name,"surname":$scope.Booking.Passenger[i].surname,"kind_doc":$scope.Booking.Passenger[i].kind_doc,"num_doc":$scope.Booking.Passenger[i].num_doc,"gender":$scope.Booking.Passenger[i].gender,"birthdate":$scope.Booking.Passenger[i].birthdate,"residence":$scope.Booking.Passenger[i].residence,"nationality":$scope.Booking.Passenger[i].nationality});
                  }
                  $http
                    .post("bookingPackage.php", _data)
                    .success(function(data, status, headers, config) {
                        $scope.getBooking = data;
                    }).error(function(data, status, headers, config) {
                        swal('Lo sentimos!', 'El request no pudo ser procesado.', 'error');
                  });
            }
    });