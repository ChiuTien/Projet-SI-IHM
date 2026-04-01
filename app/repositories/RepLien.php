<?php 
namespace app\repositories;

use Flight;
use PDO;
use PDOException;

class RepLien {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($lien) {
        try {
            $sql = "INSERT INTO lien (id_etat, id_candidat, nb_vote) VALUES (:id_etat, :id_candidat, :nb_vote)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_etat', $lien->getIdEtat(), PDO::PARAM_INT);
            $stmt->bindValue(':id_candidat', $lien->getIdCandidat(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_vote', $lien->getNbVote(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion: " . $e->getMessage());
        }
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM lien";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM lien WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function update($lien) {
        try {
            $sql = "UPDATE lien SET id_etat = :id_etat, id_candidat = :id_candidat, nb_vote = :nb_vote WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':id_etat', $lien->getIdEtat(), PDO::PARAM_INT);
            $stmt->bindValue(':id_candidat', $lien->getIdCandidat(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_vote', $lien->getNbVote(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour: " . $e->getMessage());
        }
    }

    public function delete($lien) {
        try {
            $sql = "DELETE FROM lien WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la suppression: " . $e->getMessage());
        }
    }

    public function getPourcentageVoixByPays($idPays) {
        try {
            $sql = "
                SELECT
                    l.id_candidat,
                    c.nom AS nom_candidat,
                    SUM(l.nb_vote) AS nb_voix,
                    CASE
                        WHEN pop.total_population = 0 THEN 0
                        ELSE ROUND((SUM(l.nb_vote) * 100) / pop.total_population, 2)
                    END AS pourcentage
                FROM lien l
                INNER JOIN etat e ON e.id = l.id_etat
                INNER JOIN candidat c ON c.id = l.id_candidat
                INNER JOIN (
                    SELECT COALESCE(SUM(nb_population), 0) AS total_population
                    FROM etat
                    WHERE id_pays = :id_pays_population
                ) pop
                WHERE e.id_pays = :id_pays
                GROUP BY l.id_candidat, c.nom, pop.total_population
                ORDER BY nb_voix DESC
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pays_population', $idPays, PDO::PARAM_INT);
            $stmt->bindValue(':id_pays', $idPays, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors du calcul des pourcentages: " . $e->getMessage());
        }
    }

}
