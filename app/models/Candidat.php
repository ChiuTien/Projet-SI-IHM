<?php 
    namespace app\models;

    class Candidat {
        private $idCandidat;
        private $nomCandidat;
        private $prenomCandidat;
        private $ageCandidat;
        private $nbEtatGagner;
        private $nbElecteurGagner;

        public function __construct($idCandidat, $nomCandidat, $prenomCandidat, $ageCandidat, $nbEtatGagner = 0, $nbElecteurGagner = 0) {
            $this->idCandidat = $idCandidat;
            $this->nomCandidat = $nomCandidat;
            $this->prenomCandidat = $prenomCandidat;
            $this->ageCandidat = $ageCandidat;
            $this->nbEtatGagner = $nbEtatGagner;
            $this->nbElecteurGagner = $nbElecteurGagner;
        }

        public function setIdCandidat($idCandidat) {
            $this->idCandidat = $idCandidat;
        }
        public function setNomCandidat($nomCandidat) {
            $this->nomCandidat = $nomCandidat;
        }
        public function setPrenomCandidat($prenomCandidat) {
            $this->prenomCandidat = $prenomCandidat;
        }
        public function setAgeCandidat($ageCandidat) {
            $this->ageCandidat = $ageCandidat;
        }
        public function setNbEtatGagner($nbEtatGagner) {
            $this->nbEtatGagner = $nbEtatGagner;
        }
        public function setNbElecteurGagner($nbElecteurGagner) {
            $this->nbElecteurGagner = $nbElecteurGagner;
        }

        public function getIdCandidat() {
            return $this->idCandidat;
        }
        public function getNomCandidat() {
            return $this->nomCandidat;
        }
        public function getPrenomCandidat() {
            return $this->prenomCandidat;
        }
        public function getAgeCandidat() {
            return $this->ageCandidat;
        }
        public function getNbEtatGagner() {
            return $this->nbEtatGagner;
        }
        public function getNbElecteurGagner() {
            return $this->nbElecteurGagner;
        }
    }
?>