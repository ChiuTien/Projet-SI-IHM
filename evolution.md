# Lecture du sujet
- Theme: Election americaine.
  - TD1: [ lu ]
    - On a plusieurs Etat qui possede un nombre definis de grands electeurs.
    - Celui qui remporte le plus de voix dans un etat gagne l'ensemble des grands electeurs de ce pays.
    - Celui qui totalise le plus de grans nb de grands electeurs remporte l'election.
    - Pour simplifier, on dit qu'il y a seulement 2 candidats(Joe Biden et D.Trump).
  - TD2:
    - Representer sous forme de carte les resultats(on n'a pas besoin de la forme exacte des etats).
      1. On doit voir:
         1. la couleur du vainqueur(bleu ou rouge).
         2. le nombre de grands electeurs.
         3. le nom de l'etat.
      2. Lorsqu'on clique sur la carte, on doit voir les details des resultats.
    - Implementer un systeme d'authentification avec deux roles(il y a donc plusieurs user):
      - Administrateur: peut saisir/modifier les resultats par etat.
      - Observateur: peut uniquement consulter les resultats et la carte.
  - TD3:
    - Chaque modification d'un resultat d'etat doit etre tracee en base de donnees(qui, quand, ancienne valeur, nouvelle valeur). Creer une interface d'audit qui affiche:
      - L'historique complet des modifications par etat.
      - La possibilite de revenir a une version precedente(rollback).
      - Un export CSV de l'historique.

# Conception de la base de donnee
  1. En vue du TD1:[x]
       - Base de donnee:
```sql
    CREATE DATABASE Election;
```
```sql
    CREATE TABLE etat(
        idEtat INT PRIMARY KEY AUTO_INCREMENT,
        nomEtat VARCHAR(100) NOT NULL,
        nbPMajeur INT NOT NULL,
        nbELecteur INT NOT NULL
    );

    CREATE TABLE candidat(
        idCandidat INT PRIMARY KEY AUTO_INCREMENT,
        nomCandidat VARCHAR(100) NOT NULL,
        prenomCandidat VARCHAR(100) NOT NULL,
        ageCandidat INT NOT NULL
    );

    CREATE TABLE ref(
        idRef INT PRIMARY KEY AUTO_INCREMENT,
        idEtat INT NOT NULL,
        idCandidat INT NOT NULL,
        nbVoix DECIMAL(3,2)
    );
```
# Recuperation des donnees sur internet:[x]
  - La liste des etats americains avec le nombre de grands electeurs.[x]
# Devellopement du projet:
1. En vu du TD1:
    - Creation des models:
      - Etat=> {idEtat, nomEtat, nbGElecteur}
      - Candidat=> {idCandidat, nomCandidat, prenomCandidat, ageCandidat}
      - Ref=> {idRef, idEtat, nomEtat, nbElecteur, idCandidat, nomCandidat, prenomCandidat, ageCandidat, nbVoix}.
    - Creation d'une repository general.
    - Creation des services:
      - EtatService=> {CRUD}
      - Candidtat=> {CRUD}
      - Ref=> {CRUD, calculEnPourcentageDesVoix, determination du candidat vainqueur dans un etat, comparaison des voix}.
    - Gestion de l'affichage:
      - page pour entre le nombre de voix de chaque candidat pour un etat en plus d'un affichage de pourcentage pour cet etat.