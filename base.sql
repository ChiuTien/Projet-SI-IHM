-- Active: 1774215634831@@127.0.0.1@3306@election

CREATE DATABASE election;

use election;

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