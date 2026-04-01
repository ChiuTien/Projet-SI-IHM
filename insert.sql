-- Active: 1774215634831@@127.0.0.1@3306@election
-- 1. Insertion des Pays
INSERT INTO pays (nom) VALUES ('France'), ('USA');

-- 2. Insertion des Candidats
INSERT INTO candidat (nom) VALUES ('Alice Smith'), ('Bob Jones');

-- 3. Insertion des États
-- (id_pays, id_candidat, nb_population, nb_electeur)
INSERT INTO etat (id_pays, id_candidat, nb_population, nb_electeur) VALUES 
(1, 1, 1000000, 800000), 
(1, 2, 500000, 400000),  
(2, 1, 2000000, 1500000), 
(2, 2, 1500000, 1200000);

-- 4. Insertion des Votes (Lien)
-- (id_etat, id_candidat, nb_vote)
INSERT INTO lien (id_etat, id_candidat, nb_vote) VALUES 
(1, 1, 500000), (1, 2, 300000),
(2, 1, 150000), (2, 2, 250000),
(3, 1, 900000), (3, 2, 600000),
(4, 1, 400000), (4, 2, 800000);