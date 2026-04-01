<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\ControllerEtat;
use app\controllers\ControllerCandidat;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	// $router->get('/', function() use ($app) {
	// 	$app->render('welcome', [ 'message' => 'You are gonna do great things!' ]);
	// });

	// $router->get('/hello-world/@name', function($name) {
	// 	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	// });

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });

	$router->get('/candidat', function() use ($app) {
		$controllerCandidat = new ControllerCandidat();
		$candidats = $controllerCandidat->getAll();
		$app->render('candidat', [ 'candidats' => $candidats ]);
	});

	$router->get('/etat/sumElecteur/@idCandidat:[0-9]', function($idCandidat) use ($app) {
		$controllerEtat = new ControllerEtat();
		$controllerCandidat = new ControllerCandidat();
		$sum = $controllerEtat->sumElecteurBycandidat($idCandidat);
		$candidat = $controllerCandidat->getById($idCandidat);
		$app->render('result', [
			'sum' => $sum,
			'candidat' => $candidat,
		]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);