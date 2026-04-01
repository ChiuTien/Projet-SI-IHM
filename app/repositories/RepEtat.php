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
        $sql = "INSERT INTO etat (id_pays, id_candidat, nb_population, nb_electeur) VALUES (:id_pays, :id_candidat, :nb_population, :nb_electeur)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_pays', $etat->getIdPays(), PDO::PARAM_INT);
        $stmt->bindValue(':id_candidat', $etat->getIdCandidat(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_population', $etat->getNbPopulation(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_electeur', $etat->getNbElecteur(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function findAll() {
        $sql = "SELECT * FROM etat";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $sql = "SELECT * FROM etat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($etat) {
        $sql = "UPDATE etat SET id_pays = :id_pays, id_candidat = :id_candidat, nb_population = :nb_population, nb_electeur = :nb_electeur WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id_pays', $etat->getIdPays(), PDO::PARAM_INT);
        $stmt->bindValue(':id_candidat', $etat->getIdCandidat(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_population', $etat->getNbPopulation(), PDO::PARAM_INT);
        $stmt->bindValue(':nb_electeur', $etat->getNbElecteur(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($etat) {
        $sql = "DELETE FROM etat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

}
