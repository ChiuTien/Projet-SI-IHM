<?php 
    namespace app\services;

    use app\repositories\RepRef;

    class ServRef {
        private RepRef $repRef;

        public function __construct() {
            $this->repRef = new RepRef();
        }

        public function save($ref) {
            return $this->repRef->save($ref);
        }
        public function delete($idRef) {
            return $this->repRef->delete($idRef);
        }
        public function update($ref) {
            return $this->repRef->update($ref);
        }
        public function findById($idRef) {
            return $this->repRef->findById($idRef);
        }
        public function findAll() {
            return $this->repRef->findAll();
        }
    }
?>
