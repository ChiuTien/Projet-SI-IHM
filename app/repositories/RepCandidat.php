<?php 
    namespace app\repositories;

    use Flight;
    use PDO;
    use PDOException;

    class RepCandidat {
        private PDO $db;

        public function __construct() {
            $this->db = Flight::db();
        }

        public function save($candidat) {
            try {
                $sql = "INSERT INTO candidat (idCandidat, nomCandidat, prenomCandidat, ageCandidat, nbEtatGagner, nbElecteurGagner) VALUES (:idCandidat, :nomCandidat, :prenomCandidat, :ageCandidat, :nbEtatGagner, :nbElecteurGagner)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idCandidat', $candidat->getIdCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nomCandidat', $candidat->getNomCandidat(), PDO::PARAM_STR);
                $stmt->bindValue(':prenomCandidat', $candidat->getPrenomCandidat(), PDO::PARAM_STR);
                $stmt->bindValue(':ageCandidat', $candidat->getAgeCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nbEtatGagner', $candidat->getNbEtatGagner(), PDO::PARAM_INT);
                $stmt->bindValue(':nbElecteurGagner', $candidat->getNbElecteurGagner(), PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function delete($idCandidat) {
            try {
                $sql = "DELETE FROM candidat WHERE idCandidat = :idCandidat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idCandidat', $idCandidat, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function update($candidat) {
            try {
                $sql = "UPDATE candidat SET nomCandidat = :nomCandidat, prenomCandidat = :prenomCandidat, ageCandidat = :ageCandidat, nbEtatGagner = :nbEtatGagner, nbElecteurGagner = :nbElecteurGagner WHERE idCandidat = :idCandidat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idCandidat', $candidat->getIdCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nomCandidat', $candidat->getNomCandidat(), PDO::PARAM_STR);
                $stmt->bindValue(':prenomCandidat', $candidat->getPrenomCandidat(), PDO::PARAM_STR);
                $stmt->bindValue(':ageCandidat', $candidat->getAgeCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nbEtatGagner', $candidat->getNbEtatGagner(), PDO::PARAM_INT);
                $stmt->bindValue(':nbElecteurGagner', $candidat->getNbElecteurGagner(), PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function findAll() {
            try {
                $sql = "SELECT * FROM candidat";
                $stmt = $this->db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return [];
            }
        }

        public function findById($idCandidat) {
            try {
                $sql = "SELECT * FROM candidat WHERE idCandidat = :idCandidat";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idCandidat', $idCandidat, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return null;
            }
        }
    }
?>
