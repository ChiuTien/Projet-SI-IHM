<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\ControllerEtat;
use app\controllers\ControllerCandidat;
use app\controllers\ControllerLien;

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

	$router->get('/resultat/saisie', function() use ($app) {
		$controllerEtat = new ControllerEtat();
		$controllerCandidat = new ControllerCandidat();
		$controllerLien = new ControllerLien();

		$etats = $controllerEtat->getAllWithPaysName();
		$candidats = $controllerCandidat->getAll();
		$classement = $controllerLien->getPourcentageParEtatEtCandidat();

		$app->render('saisie_resultat', [
			'etats' => $etats,
			'candidats' => $candidats,
			'classement' => $classement,
			'selectedEtatId' => 0,
			'message' => '',
		]);
	});

	$router->post('/resultat/saisie', function() use ($app) {
		$controllerEtat = new ControllerEtat();
		$controllerCandidat = new ControllerCandidat();
		$controllerLien = new ControllerLien();

		$etats = $controllerEtat->getAllWithPaysName();
		$candidats = $controllerCandidat->getAll();

		$selectedEtatId = isset($_POST['id_etat']) ? (int) $_POST['id_etat'] : 0;
		$votes = $_POST['votes'] ?? [];
		$message = 'Selection invalide.';

		if ($selectedEtatId > 0 && is_array($votes)) {
			foreach ($candidats as $candidatItem) {
				$idCandidat = (int) ($candidatItem['id'] ?? 0);
				if ($idCandidat <= 0) {
					continue;
				}

				$rawVote = $votes[$idCandidat] ?? 0;
				$nbVote = max(0, (int) $rawVote);
				$controllerLien->saveOrUpdateVoteByEtatAndCandidat($selectedEtatId, $idCandidat, $nbVote);
			}

			$message = 'Resultat enregistre avec succes.';
		}

		$classement = $controllerLien->getPourcentageParEtatEtCandidat();

		$app->render('saisie_resultat', [
			'etats' => $etats,
			'candidats' => $candidats,
			'classement' => $classement,
			'selectedEtatId' => $selectedEtatId,
			'message' => $message,
		]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);