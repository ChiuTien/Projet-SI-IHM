<?php 
    use app\models\Etat;
    use app\repositories\RepEtat;

    $repEtat = new RepEtat();
    $etat1 = new Etat(1, "California", 20000000, 30000000);
    
    if ($repEtat->save($etat1)) {
        echo "État enregistré avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement de l'état.";
    }
?>