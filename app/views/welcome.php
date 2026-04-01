<?php 
require('../vendor/autoload.php');

use app\controllers\ControllerEtat;
use app\models\Pays;
?>

<h1>Welcome to the FlightPHP Skeleton Example!</h1>
<?php 
    $controller = new ControllerEtat();

    // $valiny = $controller->sumElecteurBycandidat(1);
    // echo "Nombre total d'électeurs pour le candidat 1 : " . $valiny;

    // $pays = new Pays();
    // $pays->setId(3);
    // $pays->setNom("Mada");
    // $controller->create($pays);
    // echo "Pays ajouté : " . $pays->getNom();
?>