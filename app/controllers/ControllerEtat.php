<?php 
namespace app\controllers;

use app\repositories\RepEtat;
use app\models\Etat;

class ControllerEtat {
    private RepEtat $repEtat;

    public function __construct() {
        $this->repEtat = new RepEtat();
    }

    public function create($data) {
        return $this->repEtat->save($data);
    }

    public function getAll() {
        return $this->repEtat->findAll();
    }

    public function getById($id) {
        return $this->repEtat->findById($id);
    }

    public function update($data) {
        return $this->repEtat->update($data);
    }

    public function delete($data) {
        return $this->repEtat->delete($data);
    }

    public function sumElecteurBycandidat($idCandidat) {
        return $this->repEtat->sumElecteurByCandidat($idCandidat);
    }
}
?>
