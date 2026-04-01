<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;

use flight\Engine;
use flight\net\Router;

use app\services\ServEtat;
use app\services\ServCandidat;
use app\services\ServRef;

use app\models\Etat;
use app\models\Candidat;
use app\models\Ref;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$servCandidat = new ServCandidat();
		$servEtat = new ServEtat();
		$servRef = new ServRef();

		$candidats = $servCandidat->findAll();
		$etats = $servEtat->findAll();
		$refs = $servRef->findAll();

		$app->render('welcome', [
			'candidats' => $candidats,
			'etats' => $etats,
			'refs' => $refs
		]);
	});

	$showImportPage = function() use ($app) {
		$app->render('import-txt', [
			'message' => null,
			'preview' => null
		]);
	};

	$handleImportPost = function() use ($app) {
		$message = null;
		$preview = null;
		$inserted = 0;
		$skipped = 0;

		if (!isset($_FILES['txt_file']) || $_FILES['txt_file']['error'] !== UPLOAD_ERR_OK) {
			$message = 'Aucun fichier valide envoye.';
			$app->render('import-txt', [
				'message' => $message,
				'preview' => $preview
			]);
			return;
		}

		$tmpPath = $_FILES['txt_file']['tmp_name'];
		$content = file_get_contents($tmpPath);
		if ($content === false) {
			$message = 'Impossible de lire le fichier envoye.';
			$app->render('import-txt', [
				'message' => $message,
				'preview' => $preview
			]);
			return;
		}

		$preview = mb_substr($content, 0, 1000);
		$lines = preg_split('/\R/', $content);
		$servEtat = new ServEtat();

		foreach ($lines as $line) {
			$line = trim((string) $line);
			if ($line === '') {
				continue;
			}

			$parts = explode(' - ', $line);
			if (count($parts) !== 3) {
				$skipped++;
				continue;
			}

			$nomEtat = trim($parts[0]);
			$nbPMajeur = (int) trim($parts[1]);
			$nbElecteur = (int) trim($parts[2]);

			if ($nomEtat === '' || $nbPMajeur <= 0 || $nbElecteur <= 0) {
				$skipped++;
				continue;
			}

			$etat = new Etat(0, $nomEtat, $nbPMajeur, $nbElecteur);
			if ($servEtat->save($etat)) {
				$inserted++;
			} else {
				$skipped++;
			}
		}

		$message = 'Import termine: ' . $inserted . ' ligne(s) inseree(s), ' . $skipped . ' ignoree(s).';
		$app->render('import-txt', [
			'message' => $message,
			'preview' => $preview
		]);
	};

	$router->get('/import-txt', $showImportPage);
	$router->get('/import-txt/', $showImportPage);
	$router->get('/index.php/import-txt', $showImportPage);
	$router->post('/import-txt', $handleImportPost);
	$router->post('/index.php/import-txt', $handleImportPost);
	
}, [ SecurityHeadersMiddleware::class ]);