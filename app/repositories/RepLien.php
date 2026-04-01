<?php 
namespace app\repositories;

use Flight;
use PDO;

class RepLien {
    private PDO $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function save($lien) {
        $sql = "INSERT INTO lien (id_etat, id_candidat, nb_vote) VALUES (:id_etat, :id_candidat, :nb_vote)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_etat', $lien->getIdEtat(), PDO::PARAM_INT);
        $stmt->bindValue(':id_candidat', $lien->getIdCandidat(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_vote', $lien->getNbVote(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function findAll() {
        $sql = "SELECT * FROM lien";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM lien WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($lien) {
        $sql = "UPDATE lien SET id_etat = :id_etat, id_candidat = :id_candidat, nb_vote = :nb_vote WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id_etat', $lien->getIdEtat(), PDO::PARAM_INT);
        $stmt->bindValue(':id_candidat', $lien->getIdCandidat(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_vote', $lien->getNbVote(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($lien) {
        $sql = "DELETE FROM lien WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $lien->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

}
