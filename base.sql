-- Active: 1774215634831@@127.0.0.1@3306@election
CREATE TABLE pays (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE etat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pays INT, 
    id_gd_electeurs INT,
    vote INT
);

CREATE TABLE gd_electeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);