## Lecture du sujet 
    - Conception de la base 
        - pays 
        - etat 
        - lien
        - candidat
```bash
    CREATE TABLE pays (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE etat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pays INT, 
    id_candidat INT,
    nb_population INT,
    nb_electeur INT
);

CREATE TABLE lien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_etat INT,
    id_candidat INT,
    nb_vote INT
);

CREATE TABLE candidat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);
```
    
## Travaux à faire 1 
a - Saisie resultat 
    - options []
    - input * 2 []
    - button []
    - Tableau de resultat à chaque etat []
        - th []
            - tr * 3 []
(boucle)- td []
            - fct getPays []
            - Fct nb []

    
b - Voir les résultats 
    -  Tableau somme des resultats pour chaque candidat []
        - th [x]
            - tr * 2 [x]
        - td []
            - tr anarana []
            - tr fct getSommeTotalByGdElecteurs []  
        
        fct getSommeTotalByGdElecteurs(idCandidat) [x]
            - sum(nb_Electeur) [x]
            - idCandidat [x]

2 - Export PDF
    