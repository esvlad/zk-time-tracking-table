<?php

namespace Esvlad\ZkTimeTrackingTable\Controllers;

use Esvlad\ZkTimeTrackingTable\Models\Table;

class Form extends Controller{
	public function index(){
		$req = $this->request->all();

		return $this->render('form/index', ['request' => $req]);
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