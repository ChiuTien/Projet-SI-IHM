<?php 
    namespace app\services;

    use app\repositories\RepEtat;
    use app\models\Etat;

    class ServEtat {
        private RepEtat $repEtat;

        public function __construct() {
            $this->repEtat = new RepEtat();
        }
        
        public function save($etat) {
            return $this->repEtat->save($etat);
        }
        public function delete($idEtat) {
            return $this->repEtat->delete($idEtat);
        }
        public function update($etat) {
            return $this->repEtat->update($etat);
        }
        public function findById($idEtat) {
            return $this->repEtat->findById($idEtat);
        }
        public function findAll() {
            return $this->repEtat->findAll();
        }
    }
?>