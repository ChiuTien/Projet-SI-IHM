<?php 
namespace app\models;

class Pays {
    private $id;
    private $nom;

    public function __construct() {}

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    
}
?>