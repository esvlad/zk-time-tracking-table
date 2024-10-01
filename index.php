<?php
require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function storage($path){
	return $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path . '/';
}

function storage_set($path){
	if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path)){
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path, 0777, True);
	}

	return $_SERVER['DOCUMENT_ROOT']  . '/storage/' . $path . '/';
}

function linkpath($path = false){
	$url = $_SERVER['REQUEST_SCHEME'];
	$url .= '://';
	$url .= $_SERVER['SERVER_NAME'];

	if(!empty($path)){
		$url .= $path;
	}

	return $url;
}

function filepath($file){
	$url = linkpath();
	$url .= '/storage/';
	$url .= $file;

	return $url;
}

require "debug.php";
require "routers.php";