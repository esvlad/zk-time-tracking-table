<?php

namespace Esvlad\ZkTimeTrackingTable\Models;

class Table{
	public function timing($hours_cell = '', $su = false)
	{
		if(empty($hours_cell)) return null;

		$hours = str_split($hours_cell, 5);

		$start = strtotime(current($hours));
		$end = strtotime(array_pop($hours));

		$time = ($end - $start) / 60 / 60 - .5;
		$time = round($time, 1);

		if($su !== true && $time > 8){
			$time = 8;
		}

		if($time < 0) $time = 0;

		return $time;
	}

	public function monthName($m = 1){
		$m--;
		$month =['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

		return $month[$m];
	}
}
