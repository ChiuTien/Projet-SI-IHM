<?php 
namespace app\controllers;

use app\repositories\RepLien;
use app\models\Lien;

class ControllerLien {
    private RepLien $repLien;

    public function __construct() {
        $this->repLien = new RepLien();
    }

    public function create($data) {
        return $this->repLien->save($data);
    }

    public function getAll() {
        return $this->repLien->findAll();
    }

    public function getById($id) {
        return $this->repLien->findById($id);
    }

    public function update($data) {
        return $this->repLien->update($data);
    }

    public function delete($data) {
        return $this->repLien->delete($data);
    }
}
?>
