<?php 
    namespace app\models;

    class Etat {
        private $idEtat;
        private $nomEtat;
        private $nbPMajeur;
        private $nbElecteur;

        public function __construct($idEtat, $nomEtat, $nbPMajeur, $nbElecteur) {
            $this->idEtat = $idEtat;
            $this->nomEtat = $nomEtat;
            $this->nbPMajeur = $nbPMajeur;
            $this->nbElecteur = $nbElecteur;
        }

        public function setIdEtat($idEtat) {
            $this->idEtat = $idEtat;
        }
        public function setNomEtat($nomEtat) {
            $this->nomEtat = $nomEtat;
        }
        public function setNbPMajeur($nbPMajeur) {
            $this->nbPMajeur = $nbPMajeur;
        }
        public function setNbElecteur($nbElecteur) {
            $this->nbElecteur = $nbElecteur;
        }

        public function getIdEtat() {
            return $this->idEtat;
        }
        public function getNomEtat() {
            return $this->nomEtat;
        }
        public function getNbPMajeur() {
            return $this->nbPMajeur;
        }
        public function getNbElecteur() {
            return $this->nbElecteur;
        }
        
        // Alias pour compatibilité
        public function getNbVotants() {
            return $this->nbElecteur;
        }
    }
?>