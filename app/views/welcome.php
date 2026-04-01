<?php 
require('../vendor/autoload.php');

use app\controllers\ControllerPays;
use app\models\Pays;
?>

<h1>Welcome to the FlightPHP Skeleton Example!</h1>
<?php 
    $controller = new ControllerPays();
    $pays = new Pays();
    $pays.setId(3);
    $pays.setNom("Mada");
    $controller->create($pays);
    echo "Pays ajouté : " . $pays->getNom();
?>