<?php 
namespace app\repositories;

use Flight;
use PDO;

class RepCandidat {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($candidat) {
        $sql = "INSERT INTO candidat (nom) VALUES (:nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $candidat->getNom(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findAll() {
        $sql = "SELECT * FROM candidat";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM candidat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($candidat) {
        $sql = "UPDATE candidat SET nom = :nom WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $candidat->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nom', $candidat->getNom(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete($candidat) {
        $sql = "DELETE FROM candidat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $candidat->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

}
