<?php 
	

	 class Child
	{
	     $age; //int
	}

	 class Room
	{
	    var $adult; //int
	    var $Children; //array(Child)
	}

	class Data
	{
		var $order_type;
		var $order_field;
		var $currency;
		var $origin_place;
		var $destination_place;
		var $month_departe;
		var $year_departure;
		var $Room;
		function _construct($params){
			$this->order_type = $param['order_type'];
			$this->order_field = $param['order_field'];
			$this->currency = $param['currency'];
			$this->origin_place = $param['origin_place'];
			$this->destination_place = $param['destination_place'];
			$this->month_departe = $param['month_departe'];
			$this->year_departure = $param['year_departure'];
			$this->Room = (array)($param['Room']);
			foreach($this->Room as &$room){
				$room['Child'] = (array)($room['Child']);
			}
		}
	}



     class SearchFilter {
   		var $data;
		function _contruct($params){
			$data = new Data($params)
		}

		public function validate(){
			return Jsv4::validate(json_encode($this->data), '');
		}
   }