<?php 
namespace app\controllers;

use app\repositories\RepCandidat;
use app\models\Candidat;

class ControllerCandidat {
    private RepCandidat $repCandidat;

    public function __construct() {
        $this->repCandidat = new RepCandidat();
    }

    public function create($data) {
        return $this->repCandidat->save($data);
    }

    public function getAll() {
        return $this->repCandidat->findAll();
    }

    public function getById($id) {
        return $this->repCandidat->findById($id);
    }

    public function update($data) {
        return $this->repCandidat->update($data);
    }

    public function delete($data) {
        return $this->repCandidat->delete($data);
    }
}
?>
