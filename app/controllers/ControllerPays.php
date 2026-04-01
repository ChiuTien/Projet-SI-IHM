<?php 
namespace app\controllers;

use app\repositories\RepPays;
use app\models\Pays;

class ControllerPays {
    private RepPays $repPays;

    public function __construct() {
        $this->repPays = new RepPays();
    }

    public function create($data) {
        return $this->repPays->save($data);
    }

    public function getAll() {
        return $this->repPays->findAll();
    }

    public function getById($id) {
        return $this->repPays->findById($id);
    }

    public function update($data) {
        return $this->repPays->update($data);
    }

    public function delete($data) {
        return $this->repPays->delete($data);
    }
}
?>