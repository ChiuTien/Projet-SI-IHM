<?php 
    namespace app\services;

    use app\repositories\RepCandidat;
    use app\models\Candidat;

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

        /**
         * Trouve un candidat par ID et le retourne en array
         */
        public function findById($idCandidat) {
            return $this->repCandidat->findById($idCandidat);
        }

        /**
         * Trouve un candidat par ID et le retourne en objet Candidat
         */
        public function getCandidatById($idCandidat) {
            $data = $this->repCandidat->findById($idCandidat);
            if (!$data) {
                return null;
            }
            return new Candidat(
                $data['idCandidat'],
                $data['nomCandidat'],
                $data['prenomCandidat'],
                $data['ageCandidat'],
                $data['nbEtatGagner'] ?? 0,
                $data['nbElecteurGagner'] ?? 0
            );
        }

        /**
         * Retourne tous les candidats en tant que tableaux
         */
        public function findAll() {
            return $this->repCandidat->findAll();
        }

        /**
         * Retourne tous les candidats en tant qu'objets Candidat
         */
        public function getAllCandidats() {
            $data = $this->repCandidat->findAll();
            $candidats = [];
            foreach ($data as $item) {
                $candidats[] = new Candidat(
                    $item['idCandidat'],
                    $item['nomCandidat'],
                    $item['prenomCandidat'],
                    $item['ageCandidat'],
                    $item['nbEtatGagner'] ?? 0,
                    $item['nbElecteurGagner'] ?? 0
                );
            }
            return $candidats;
        }

        /**
         * Vérifie si un candidat existe par ID
         */
        public function candidatExists($idCandidat) {
            return $this->getCandidatById($idCandidat) !== null;
        }

        /**
         * Met à jour les stats de victoire d'un candidat
         */
        public function updateStatsVictoire($idCandidat, $nbEtatGagner, $nbElecteurGagner) {
            $candidat = $this->getCandidatById($idCandidat);
            if ($candidat) {
                $candidat->setNbEtatGagner($nbEtatGagner);
                $candidat->setNbElecteurGagner($nbElecteurGagner);
                return $this->update($candidat);
            }
            return false;
        }
    }
?>
