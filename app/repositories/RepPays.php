<?php 
namespace app\repositories;

use Flight;
use PDO;

class RepPays {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($pays) {
        $sql = "INSERT INTO pays (idPays, nom) VALUES (:idPays, :nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nom', $pays->getNom(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findAll() {
        $sql = "SELECT * FROM pays";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM pays WHERE idPays = :idPays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idPays', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($pays) {
        $sql = "UPDATE pays SET nom = :nom WHERE idPays = :idPays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nom', $pays->getNom(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete($pays) {
        $sql = "DELETE FROM pays WHERE idPays = :idPays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idPays', $pays->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

}