<?php 
    namespace app\models;

    class Candidat {
        private $idCandidat;
        private $nomCandidat;
        private $prenomCandidat;
        private $ageCandidat;

        public function __construct($idCandidat, $nomCandidat, $prenomCandidat, $ageCandidat) {
            $this->idCandidat = $idCandidat;
            $this->nomCandidat = $nomCandidat;
            $this->prenomCandidat = $prenomCandidat;
            $this->ageCandidat = $ageCandidat;
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
    }
?>