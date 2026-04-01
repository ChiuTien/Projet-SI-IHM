<?php 
    namespace app\models;

    class Ref {
        private $idRef;
        private $idEtat;
        private $idCandidat;
        private $nbVoix;

        public function __construct($idRef, $idEtat, $idCandidat, $nbVoix) {
            $this->idRef = $idRef;
            $this->idEtat = $idEtat;
            $this->idCandidat = $idCandidat;
            $this->nbVoix = $nbVoix;
        }

        public function setIdRef($idRef) {
            $this->idRef = $idRef;
        }
        public function setIdEtat($idEtat) {
            $this->idEtat = $idEtat;
        }
        public function setIdCandidat($idCandidat) {
            $this->idCandidat = $idCandidat;
        }
        public function setNbVoix($nbVoix) {
            $this->nbVoix = $nbVoix;
        }

        public function getIdRef() {
            return $this->idRef;
        }
        public function getIdEtat() {
            return $this->idEtat;
        }
        public function getIdCandidat() {
            return $this->idCandidat;
        }
        public function getNbVoix() {
            return $this->nbVoix;
        }
    }
?>