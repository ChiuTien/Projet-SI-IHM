<?php 
namespace app\models;

class Lien {
    private $id;
    private $id_etat;
    private $id_candidat;
    private $nb_vote;

    public function __construct() {}

    public function getId() {
        return $this->id;
    }

    public function getIdEtat() {
        return $this->id_etat;
    }

    public function getIdCandidat() {
        return $this->id_candidat;
    }

    public function getNbVote() {
        return $this->nb_vote;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdEtat($id_etat) {
        $this->id_etat = $id_etat;
    }

    public function setIdCandidat($id_candidat) {
        $this->id_candidat = $id_candidat;
    }

    public function setNbVote($nb_vote) {
        $this->nb_vote = $nb_vote;
    }
    
}
?>