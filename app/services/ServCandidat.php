<?php 
    namespace app\services;

    use app\repositories\RepCandidat;

    class ServCandidat {
        private RepCandidat $repCandidat;

        public function __construct() {
            $this->repCandidat = new RepCandidat();
        }

        public function save($candidat) {
            return $this->repCandidat->save($candidat);
        }
        public function delete($idCandidat) {
            return $this->repCandidat->delete($idCandidat);
        }
        public function update($candidat) {
            return $this->repCandidat->update($candidat);
        }
        public function findById($idCandidat) {
            return $this->repCandidat->findById($idCandidat);
        }
        public function findAll() {
            return $this->repCandidat->findAll();
        }
    }
?>
