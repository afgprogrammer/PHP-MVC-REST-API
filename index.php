<?php

require 'config.php';
require SYSTEM . 'Startup.php';

use Router\Router;

$request = new Http\Request();
$response = new Http\Response();
$response->setHeader('Access-Control-Allow-Origin: *');
$response->setHeader('Content-Type: application/json; charset=UTF-8');

$router = new Router('/' . $request->getUrl(), $request->getMethod());
require 'Router/Router.php';
// Rouetr path

// Router Run Request
$router->run();

// Response Render Content
$response->render();
