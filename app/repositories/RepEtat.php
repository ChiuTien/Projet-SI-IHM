<?php 
namespace app\repositories;

use Flight;
use PDO;
use PDOException;

class RepEtat {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($etat) {
        try {
            $sql = "INSERT INTO etat (id_pays, id_candidat, nb_population, nb_electeur) VALUES (:id_pays, :id_candidat, :nb_population, :nb_electeur)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pays', $etat->getIdPays(), PDO::PARAM_INT);
            $stmt->bindValue(':id_candidat', $etat->getIdCandidat(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_population', $etat->getNbPopulation(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_electeur', $etat->getNbElecteur(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion: " . $e->getMessage());
        }
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM etat";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM etat WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function update($etat) {
        try {
            $sql = "UPDATE etat SET id_pays = :id_pays, id_candidat = :id_candidat, nb_population = :nb_population, nb_electeur = :nb_electeur WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':id_pays', $etat->getIdPays(), PDO::PARAM_INT);
            $stmt->bindValue(':id_candidat', $etat->getIdCandidat(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_population', $etat->getNbPopulation(), PDO::PARAM_INT);
            $stmt->bindValue(':nb_electeur', $etat->getNbElecteur(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour: " . $e->getMessage());
        }
    }

    public function delete($etat) {
        try {
            $sql = "DELETE FROM etat WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la suppression: " . $e->getMessage());
        }
    }

    public function sumElecteurBycandidat($id_candidat) {
        try {
            $sql = "SELECT SUM(nb_electeur) as total_electeur FROM etat WHERE id_candidat = :id_candidat";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_candidat', $id_candidat, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_electeur'] ?? 0;
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function findAllWithPaysName() {
        try {
            $sql = "
                SELECT
                    e.id,
                    e.id_pays,
                    e.nb_population,
                    p.nom AS nom_etat
                FROM etat e
                INNER JOIN pays p ON p.id = e.id_pays
                ORDER BY p.nom ASC
            ";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des etats: " . $e->getMessage());
        }
    }
}
