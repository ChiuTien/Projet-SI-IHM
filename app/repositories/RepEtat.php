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
            try {
                $sql = "INSERT INTO etat (idEtat, nomEtat, nbPMajeur, nbElecteur) VALUES (:idEtat, :nomEtat, :nbPMajeur, :nbElecteur)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idEtat', $etat->getIdEtat(), PDO::PARAM_INT);
                $stmt->bindValue(':nomEtat', $etat->getNomEtat(), PDO::PARAM_STR);
                $stmt->bindValue(':nbPMajeur', $etat->getNbPMajeur(), PDO::PARAM_INT);
                $stmt->bindValue(':nbElecteur', $etat->getNbElecteur(), PDO::PARAM_INT);
            return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function delete($idEtat) {
            try {
                $sql = "DELETE FROM etat WHERE idEtat = :idEtat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idEtat', $idEtat, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function update($etat) {
            try {
                $sql = "UPDATE etat SET nomEtat = :nomEtat, nbPMajeur = :nbPMajeur, nbElecteur = :nbElecteur WHERE idEtat = :idEtat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idEtat', $etat->getIdEtat(), PDO::PARAM_INT);
                $stmt->bindValue(':nomEtat', $etat->getNomEtat(), PDO::PARAM_STR);
                $stmt->bindValue(':nbPMajeur', $etat->getNbPMajeur(), PDO::PARAM_INT);
                $stmt->bindValue(':nbElecteur', $etat->getNbElecteur(), PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function findAll() {
            try {
                $sql = "SELECT * FROM etat";
                $stmt = $this->db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return [];
            }
        }

        public function findById($idEtat) {
            try {
                $sql = "SELECT * FROM etat WHERE idEtat = :idEtat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idEtat', $idEtat, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return null;
            }
        }
    }
?>