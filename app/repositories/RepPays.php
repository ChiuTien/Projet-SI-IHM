<?php 
namespace app\repositories;

use Flight;
use PDO;
use PDOException;

class RepPays {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($pays) {
        try {
            $sql = "INSERT INTO pays (idPays, nom) VALUES (:idPays, :nom)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':nom', $pays->getNom(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion: " . $e->getMessage());
        }
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM pays";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM pays WHERE idPays = :idPays";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idPays', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération: " . $e->getMessage());
        }
    }

    public function update($pays) {
        try {
            $sql = "UPDATE pays SET nom = :nom WHERE idPays = :idPays";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':nom', $pays->getNom(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour: " . $e->getMessage());
        }
    }

    public function delete($pays) {
        try {
            $sql = "DELETE FROM pays WHERE idPays = :idPays";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la suppression: " . $e->getMessage());
        }
    }

}