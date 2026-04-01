<?php 
    namespace app\models;

    class Etat {
        private $idEtat;
        private $nomEtat;
        private $nmbPMajeur;
        private $nbElecteur;

        public function __construct($idEtat, $nomEtat, $nmbPMajeur, $nbElecteur) {
            $this->idEtat = $idEtat;
            $this->nomEtat = $nomEtat;
            $this->nmbPMajeur = $nmbPMajeur;
            $this->nbElecteur = $nbElecteur;
        }

        public function setIdEtat($idEtat) {
            $this->idEtat = $idEtat;
        }
        public function setNomEtat($nomEtat) {
            $this->nomEtat = $nomEtat;
        }
        public function setNmbPMajeur($nmbPMajeur) {
            $this->nmbPMajeur = $nmbPMajeur;
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
        public function getNmbPMajeur() {
            return $this->nmbPMajeur;
        }
        public function getNbElecteur() {
            return $this->nbElecteur;
        }
    }
?>