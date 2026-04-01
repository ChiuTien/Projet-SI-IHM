<?php 
    namespace app\repositories;

    use Flight;
    use PDO;
    
    class RepEtat {
        private PDO $db;

        public function __construct() {
            $this->db = Flight::db();
        }

        public function save($etat) {
            $sql = "INSERT INTO etat (idEtat, nomEtat, nbPMajeur, nbElecteur) VALUES (:idEtat, :nomEtat, :nbPMajeur, :nbElecteur)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idEtat', $etat->getIdEtat(), PDO::PARAM_INT);
            $stmt->bindValue(':nomEtat', $etat->getNomEtat(), PDO::PARAM_STR);
            $stmt->bindValue(':nbPMajeur', $etat->getNbPMajeur(), PDO::PARAM_INT);
            $stmt->bindValue(':nbElecteur', $etat->getNbElecteur(), PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>