<?php 
    namespace app\repositories;

    use Flight;
    use PDO;
    use PDOException;

    class RepRef {
        private PDO $db;

        public function __construct() {
            $this->db = Flight::db();
        }

        public function save($ref) {
            try {
                $sql = "INSERT INTO ref (idRef, idEtat, idCandidat, nbVoix) VALUES (:idRef, :idEtat, :idCandidat, :nbVoix)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idRef', $ref->getIdRef(), PDO::PARAM_INT);
                $stmt->bindValue(':idEtat', $ref->getIdEtat(), PDO::PARAM_INT);
                $stmt->bindValue(':idCandidat', $ref->getIdCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nbVoix', (string) $ref->getNbVoix(), PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function delete($idRef) {
            try {
                $sql = "DELETE FROM ref WHERE idRef = :idRef";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idRef', $idRef, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function update($ref) {
            try {
                $sql = "UPDATE ref SET idEtat = :idEtat, idCandidat = :idCandidat, nbVoix = :nbVoix WHERE idRef = :idRef";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idRef', $ref->getIdRef(), PDO::PARAM_INT);
                $stmt->bindValue(':idEtat', $ref->getIdEtat(), PDO::PARAM_INT);
                $stmt->bindValue(':idCandidat', $ref->getIdCandidat(), PDO::PARAM_INT);
                $stmt->bindValue(':nbVoix', (string) $ref->getNbVoix(), PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return false;
            }
        }

        public function findAll() {
            try {
                $sql = "SELECT * FROM ref";
                $stmt = $this->db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return [];
            }
        }

        public function findById($idRef) {
            try {
                $sql = "SELECT * FROM ref WHERE idRef = :idRef";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':idRef', $idRef, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                return null;
            }
        }
    }
?>
