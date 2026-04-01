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
            $sql = "INSERT INTO candidat (nom) VALUES (:nom)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nom', $candidat->getNom(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion: " . $e->getMessage());
        }
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM candidat";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM candidat WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function update($candidat) {
        try {
            $sql = "UPDATE candidat SET nom = :nom WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $candidat->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':nom', $candidat->getNom(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour: " . $e->getMessage());
        }
    }

    public function delete($candidat) {
        try {
            $sql = "DELETE FROM candidat WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $candidat->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la suppression: " . $e->getMessage());
        }
    }

}
