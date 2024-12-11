<?php

namespace Esvlad\ZkTimeTrackingTable\Models;

class Table{
	public function timing($hours_cell = '', $su = false)
	{
		if(empty($hours_cell)) return null;

		$hours = str_split($hours_cell, 5);

		$start = current($hours);
		$end = array_pop($hours);

		if($su != true && ($start < '09:00')){
			$start = '09:00';
		}

		$start = strtotime($start);
		$end = strtotime($end);

		$time = ($end - $start) / 60 / 60 - .5;
		$time = round($time, 1);

		if($su !== true && $time > 8){
			$time = 8;
		}

		if($time < 0) $time = 0;

		return $this->roundToHalf($time);
	}

	public function monthName($m = 1){
		$m--;
		$month =['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

		return $month[$m];
	}

	public function roundToHalf($num) {
		return round($num * 2) / 2;
	}
}
