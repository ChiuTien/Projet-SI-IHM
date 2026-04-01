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
        
        /**
         * Trouve un Ref par ID et retourne un array
         */
        public function findById($idRef) {
            return $this->repRef->findById($idRef);
        }

        /**
         * Trouve un Ref par ID et le retourne en objet Ref
         */
        public function getRefById($idRef) {
            $data = $this->repRef->findById($idRef);
            if (!$data) {
                return null;
            }
            return new Ref($data['idRef'], $data['idEtat'], $data['idCandidat'], $data['nbVoix']);
        }

        /**
         * Retourne tous les Refs en tant que tableaux
         */
        public function findAll() {
            return $this->repRef->findAll();
        }

        /**
         * Retourne tous les Refs en tant qu'objets Ref
         */
        public function getAllRefs() {
            $data = $this->repRef->findAll();
            $refs = [];
            foreach ($data as $item) {
                $refs[] = new Ref($item['idRef'], $item['idEtat'], $item['idCandidat'], $item['nbVoix']);
            }
            return $refs;
        }

        /**
         * Obtient le candidat pour une ligne de référendum
         */
        public function getCandidatForRef($refData) {
            $idCandidat = isset($refData['idCandidat']) ? $refData['idCandidat'] : $refData->getIdCandidat();
            return $this->servCandidat->getCandidatById($idCandidat);
        }

        /**
         * Obtient l'état pour une ligne de référendum
         */
        public function getEtatForRef($refData) {
            $idEtat = isset($refData['idEtat']) ? $refData['idEtat'] : $refData->getIdEtat();
            return $this->servEtat->getEtatById($idEtat);
        }

        /**
         * Calcule le pourcentage de voix relative à un état
         */
        public function calculePourcentageVoix($refData) {
            $nbVoix = isset($refData['nbVoix']) ? $refData['nbVoix'] : $refData->getNbVoix();
            $idEtat = isset($refData['idEtat']) ? $refData['idEtat'] : $refData->getIdEtat();
            
            $etat = $this->servEtat->getEtatById($idEtat);
            if (!$etat) {
                throw new \Exception("État ID $idEtat introuvable");
            }
            $nbVotants = $etat->getNbVotants();
            if ($nbVotants <= 0) {
                return 0;
            }
            $pourcentage = ($nbVoix * 100) / $nbVotants;
            return $pourcentage;
        }

        /**
         * Obtient tous les Refs pour un état
         */
        public function getRefsByEtat($idEtat) {
            $refs = $this->findAll();
            $result = [];
            foreach ($refs as $ref) {
                if ((isset($ref['idEtat']) ? $ref['idEtat'] : $ref->getIdEtat()) == $idEtat) {
                    $result[] = $ref;
                }
            }
            return $result;
        }

        /**
         * Obtient le gagnant d'un état (retourne l'objet Candidat ou -1 en cas d'égalité)
         */
        public function getVainqueurInEtat($idEtat) {
            $refs = $this->getRefsByEtat($idEtat);
            if (empty($refs)) {
                return null;
            }

            $maxVoix = -1;
            $vainqueur = null;
            $egalite = false;

            foreach ($refs as $ref) {
                $nbVoix = isset($ref['nbVoix']) ? (float) $ref['nbVoix'] : (float) $ref->getNbVoix();
                if ($nbVoix > $maxVoix) {
                    $maxVoix = $nbVoix;
                    $vainqueur = $ref;
                    $egalite = false;
                } elseif ($nbVoix == $maxVoix && $nbVoix >= 0) {
                    $egalite = true;
                }
            }

            if ($egalite && $vainqueur !== null) {
                return -1; // Égalité
            }

            return $vainqueur ? $this->getCandidatForRef($vainqueur) : null;
        }

        /**
         * Obtient ou crée un Ref pour un état et candidat spécifiques
         */
        public function getRefByEtatAndCandidat($idEtat, $idCandidat) {
            $refs = $this->findAll();
            foreach ($refs as $ref) {
                if ((isset($ref['idEtat']) ? $ref['idEtat'] : $ref->getIdEtat()) == $idEtat &&
                    (isset($ref['idCandidat']) ? $ref['idCandidat'] : $ref->getIdCandidat()) == $idCandidat) {
                    return $ref;
                }
            }
            return null;
        }

        /**
         * Calcule les pourcentages de votes pour deux candidats dans un état
         * Retourne un tableau avec les pourcentages formattés
         */
        public function calculerPourcentagesEtat($idEtat, $votesC1, $votesC2) {
            $etat = $this->servEtat->getEtatById($idEtat);
            if (!$etat) {
                throw new \Exception("État ID $idEtat introuvable");
            }

            $total = $votesC1 + $votesC2;
            if ($total <= 0) {
                return [
                    'c1' => '0,00%',
                    'c2' => '0,00%',
                    'total' => 0,
                    'raw_c1' => 0,
                    'raw_c2' => 0
                ];
            }

            $pourcentC1 = ($votesC1 * 100) / $total;
            $pourcentC2 = ($votesC2 * 100) / $total;

            return [
                'c1' => number_format($pourcentC1, 2, ',', '') . '%',
                'c2' => number_format($pourcentC2, 2, ',', '') . '%',
                'total' => $total,
                'raw_c1' => $pourcentC1,
                'raw_c2' => $pourcentC2
            ];
        }

        /**
         * Enregistre les votes de deux candidats dans un état
         */
        public function enregistrerVotesEtat($idEtat, $idCandidat1, $votesC1, $idCandidat2, $votesC2) {
            $ref1 = $this->getRefByEtatAndCandidat($idEtat, $idCandidat1);
            $ref2 = $this->getRefByEtatAndCandidat($idEtat, $idCandidat2);

            // Créer ou mettre à jour les références
            if ($ref1) {
                $refObj1 = new Ref(
                    $ref1['idRef'] ?? 0,
                    $ref1['idEtat'],
                    $ref1['idCandidat'],
                    $votesC1
                );
                $this->update($refObj1);
            } else {
                $refObj1 = new Ref(0, $idEtat, $idCandidat1, $votesC1);
                $this->save($refObj1);
            }

            if ($ref2) {
                $refObj2 = new Ref(
                    $ref2['idRef'] ?? 0,
                    $ref2['idEtat'],
                    $ref2['idCandidat'],
                    $votesC2
                );
                $this->update($refObj2);
            } else {
                $refObj2 = new Ref(0, $idEtat, $idCandidat2, $votesC2);
                $this->save($refObj2);
            }

            return ['ref1' => $refObj1, 'ref2' => $refObj2];
        }

        /**
         * Obtient un résumé des résultats pour un état
         */
        public function getResultatsEtat($idEtat) {
            $etat = $this->servEtat->getEtatById($idEtat);
            if (!$etat) {
                throw new \Exception("État ID $idEtat introuvable");
            }

            $refs = $this->getRefsByEtat($idEtat);
            $resultats = [];

            foreach ($refs as $ref) {
                $candidat = $this->getCandidatForRef($ref);
                if ($candidat) {
                    $pourcentage = $this->calculePourcentageVoix($ref);
                    $resultats[] = [
                        'candidat' => $candidat,
                        'nbVoix' => isset($ref['nbVoix']) ? $ref['nbVoix'] : $ref->getNbVoix(),
                        'pourcentage' => number_format($pourcentage, 2, ',', '') . '%',
                        'pourcentage_raw' => $pourcentage
                    ];
                }
            }

            return $resultats;
        }
    }
?>

