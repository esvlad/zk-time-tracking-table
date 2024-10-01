<?php

namespace Esvlad\ZkTimeTrackingTable\Controllers;

use Esvlad\ZkTimeTrackingTable\Models\Table;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Form extends Controller{
	public function index($month = 9){
		//$req = $this->request->all();
		$table = new Table();

		$inputFileType = 'Xls';
		$inputFileName = storage('uploads/test') . '11_report.xls';
		$sheetname = 'Записи счит. карты';

		$reader = IOFactory::createReader($inputFileType);
		$reader->setLoadSheetsOnly($sheetname);
		$spreadsheet = $reader->load($inputFileName);

		$dataArray = $spreadsheet->getActiveSheet()->toArray();

		$data_rows = [];
		$data_cell = [];
		foreach ($dataArray as $key => $row) {
			$data_rows[] = $row;
			$set = false;

			if($key > 2 && $dataArray[($key - 1)][0] == 'ID') $set = true;

		    IF($set !== false){
		    	$cells = [];
		    	foreach($row as $cell){
		    		if($dataArray[($key - 1)][2] == 3){
		    			$cells[] = $table->timing($cell, true);
		    		} else {
		    			$cells[] = $table->timing($cell);
		    		}
		    	}

		    	$cells[] = array_sum($cells);
		    	$data_rows[] = $cells;
		    }
		}


		//Создадим новый файл
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->fromArray($data_rows, null, 'A1');

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$folder = 'uploads/documents/' . date('Ymd') . '/' . date('His');
		$file_name = 'Табель за ' . $table->monthName($month) . '.xlsx';
		$file_patn = storage_set($folder) . $file_name;
		$writer->save($file_patn);

		return $this->render('form/index', [
			'document_url' => filepath($folder . '/' . $file_name)
		]);
	}

	public function handler(){
		//
	}

	public function success(){
		return $this->toJson($this->request->all());
	}

	public function fail(){
		//
	}

}