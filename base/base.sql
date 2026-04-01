-- Active: 1774785660740@@127.0.0.1@3306@Election
CREATE DATABASE Election;

USE Election;

CREATE TABLE etat(
        idEtat INT PRIMARY KEY AUTO_INCREMENT,
        nomEtat VARCHAR(100) NOT NULL,
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