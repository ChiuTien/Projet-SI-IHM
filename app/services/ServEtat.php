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
        
        /**
         * Trouve un état par ID et le retourne en array
         */
        public function findById($idEtat) {
            return $this->repEtat->findById($idEtat);
        }

        /**
         * Trouve un état par ID et le retourne en objet Etat
         */
        public function getEtatById($idEtat) {
            $data = $this->repEtat->findById($idEtat);
            if (!$data) {
                return null;
            }
            return new Etat($data['idEtat'], $data['nomEtat'], $data['nbPMajeur'], $data['nbElecteur']);
        }

        /**
         * Retourne tous les états en tant que tableaux
         */
        public function findAll() {
            return $this->repEtat->findAll();
        }

        /**
         * Retourne tous les états en tant qu'objets Etat
         */
        public function getAllEtats() {
            $data = $this->repEtat->findAll();
            $etats = [];
            foreach ($data as $item) {
                $etats[] = new Etat($item['idEtat'], $item['nomEtat'], $item['nbPMajeur'], $item['nbElecteur']);
            }
            return $etats;
        }

        /**
         * Trouve un état par nom
         */
        public function findByNom($nom) {
            $all = $this->findAll();
            foreach ($all as $etat) {
                if ($etat['nomEtat'] === $nom) {
                    return $etat;
                }
            }
            return null;
        }

        /**
         * Vérifie si un état existe par ID
         */
        public function etatExists($idEtat) {
            return $this->getEtatById($idEtat) !== null;
        }
    }
?>
