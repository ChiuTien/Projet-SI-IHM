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
	$renderWelcome = function(array $extra = []) use ($app) {
		$servCandidat = new ServCandidat();
		$servEtat = new ServEtat();
		$servRef = new ServRef();

		$candidats = $servCandidat->findAll();
		$etats = $servEtat->findAll();
		$refs = $servRef->findAll();

		$app->render('welcome', array_merge([
			'candidats' => $candidats,
			'etats' => $etats,
			'refs' => $refs,
			'formData' => [
				'etat' => '',
				'votes_c1' => '',
				'votes_c2' => ''
			],
			'resultRow' => null,
			'errorMessage' => null
		], $extra));
	};

	$router->get('/', function() use ($renderWelcome) {
		$renderWelcome();
	});

	$handleWelcomePost = function() use ($renderWelcome) {
		$etatId = isset($_POST['etat']) ? (int) $_POST['etat'] : 0;
		$votesC1 = isset($_POST['votes_c1']) ? (int) $_POST['votes_c1'] : 0;
		$votesC2 = isset($_POST['votes_c2']) ? (int) $_POST['votes_c2'] : 0;

		$formData = [
			'etat' => (string) $etatId,
			'votes_c1' => isset($_POST['votes_c1']) ? (string) $_POST['votes_c1'] : '',
			'votes_c2' => isset($_POST['votes_c2']) ? (string) $_POST['votes_c2'] : ''
		];

		// Validation des données
		if ($etatId <= 0 || $votesC1 < 0 || $votesC2 < 0) {
			$renderWelcome([
				'formData' => $formData,
				'errorMessage' => 'Veuillez selectionner un etat et saisir des valeurs valides.'
			]);
			return;
		}

		// Utiliser le service pour valider l'état
		$servEtat = new ServEtat();
		if (!$servEtat->etatExists($etatId)) {
			$renderWelcome([
				'formData' => $formData,
				'errorMessage' => 'Etat introuvable.'
			]);
			return;
		}

		// Récupérer l'état pour obtenir le nom
		$etatData = $servEtat->findById($etatId);
		$etatName = $etatData['nomEtat'] ?? '';

		// Utiliser le service pour calculer les pourcentages
		$servRef = new ServRef();
		try {
			$resultats = $servRef->calculerPourcentagesEtat($etatId, $votesC1, $votesC2);
			
			$renderWelcome([
				'formData' => $formData,
				'resultRow' => [
					'etat' => $etatName,
					'c1' => $resultats['c1'],
					'c2' => $resultats['c2']
				]
			]);
		} catch (\Exception $e) {
			$renderWelcome([
				'formData' => $formData,
				'errorMessage' => 'Erreur lors du calcul: ' . $e->getMessage()
			]);
		}
	};

	$router->post('/', $handleWelcomePost);
	$router->post('/index.php', $handleWelcomePost);

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