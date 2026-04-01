<?php 
    namespace app\services;

    use app\repositories\RepRef;

    use app\services\ServCandidat;
    use app\services\ServEtat;

    use app\models\Candidat;
    use app\models\Etat;
    use app\models\Ref;

    class ServRef {
        private RepRef $repRef;
        private ServCandidat $servCandidat;
        private ServEtat $servEtat;

        public function __construct() {
            $this->repRef = new RepRef();
            $this->servCandidat = new ServCandidat();
            $this->servEtat = new ServEtat();
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

        public function getCandidatForRef($Ref) {
            $ref = $this->findById($Ref->getIdCandidat());
            if ($ref) {
                return $this->servCandidat->findById($ref->getIdCandidat());
            }
            return null;
        }
        public function getEtatForRef($Ref) {
            $ref = $this->findById($Ref->getIdEtat());
            if ($ref) {
                return $this->servEtat->findById($ref->getIdEtat());
            }
            return null;
        }
        public function calculePourcentageVoix($ref) {
            $voix = $ref->getNbVoix();
            $etat = $this->getEtatForRef($ref);
            if (!$etat) {
                throw new \Exception("État non trouvé pour le référendum ID: " . $ref->getIdRef());
                return null;
            }
            $nbVotants = $etat->getNbVotants();
            $pourcentage = ($voix * 100) / $nbVotants;
            return $pourcentage;
        }
        public function getRefs($ref) {
            $refs = $this->findAll();
            $refs2 = array();
            foreach ($refs as $r) {
                if($r->getIdEtat() == $ref->getIdEtat()) {
                    $refs2[] = $r;
                }
            }
            return $refs2;
        }
        public function vainqueurInEtat($ref) {
            $refs = $this->getRefs($ref);
            $maxVoix = -1;
            $vainqueur = null;
            $egalite = false;
            foreach ($refs as $r) {
                $nbVoix = (float) $r->getNbVoix();
                if ($nbVoix > $maxVoix) {
                    $maxVoix = $nbVoix;
                    $vainqueur = $r;
                    $egalite = false;
                } elseif ($nbVoix == $maxVoix) {
                    $egalite = true;
                }
            }
            if ($egalite && $vainqueur !== null) {
                return -1;
            }
            return $vainqueur ? $this->getCandidatForRef($vainqueur) : null;
        }
    }
?>
