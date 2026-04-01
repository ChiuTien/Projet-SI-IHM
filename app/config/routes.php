<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\ControllerPays.php;

/** 
 * @var Router $router 
 * @var Engine $app
 */
w
// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/pays', function() use ($app) {
		$controllerPays = new ControllerPays();

	});

	
}, [ SecurityHeadersMiddleware::class ]);