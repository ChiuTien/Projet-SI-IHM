<?php 
namespace app\models;

class Etat {
    private $id;
    private $id_pays;
    private $id_candidat;
    private $nb_population;
    private $nb_electeur;

    public function __construct() {}

    public function getId() {
        return $this->id;
    }

    public function getIdPays() {
        return $this->id_pays;
    }

    public function getIdCandidat() {
        return $this->id_candidat;
    }

    public function getNbPopulation() {
        return $this->nb_population;
    }

    public function getNbElecteur() {
        return $this->nb_electeur;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdPays($id_pays) {
        $this->id_pays = $id_pays;
    }

    public function setIdCandidat($id_candidat) {
        $this->id_candidat = $id_candidat;
    }

    public function setNbPopulation($nb_population) {
        $this->nb_population = $nb_population;
    }

    public function setNbElecteur($nb_electeur) {
        $this->nb_electeur = $nb_electeur;
    }
    
}
?>