create database HomeWorkCompleto;
use HomeWorkCompleto;


CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(16) NOT NULL,
    surname VARCHAR(16) NOT NULL,
    picture VARCHAR(255) DEFAULT NULL,
    copertina VARCHAR(255) DEFAULT NULL
) ENGINE = InnoDB;

CREATE TABLE film (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NULL,
    anno VARCHAR(255) NULL,
    immagine VARCHAR(255) NULL,
    autore VARCHAR(16) NULL,
    descrizione VARCHAR(255) NULL,
    UNIQUE KEY(titolo, anno)
) ENGINE = InnoDB;

CREATE TABLE preferiti (
    utente VARCHAR(24),
    id_film INTEGER,
    primary key(utente,id_film),
    foreign key(utente) REFERENCES users(username) on delete cascade on update cascade,
    foreign key(id_film) REFERENCES film(id) on delete cascade on update cascade
) ENGINE = InnoDB;
