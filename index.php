<?php
require "vendor/autoload.php";

use MiladRahimi\PhpRouter\Router;
use Esvlad\ZkTimeTrackingTable\Controllers\Form;

$router = Router::create();

$router->get('/' [Form::class, 'index']);
$router->post('/' [Form::class, 'handler']);
$router->get('/success' [Form::class, 'success']);
$router->get('/fail' [Form::class, 'fail']);

$router->dispatch();