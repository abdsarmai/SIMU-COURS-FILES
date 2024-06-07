CREATE DATABASE IF NOT EXISTS latech;

USE latech;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT(11) NOT NULL AUTO_INCREMENT,
    identifiant VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS adh (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    adresse_postale VARCHAR(255) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    adresse_mail VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE USER 'admindev'@'192.168.1.71' IDENTIFIED BY 'votre_mot_de_passelatech94@cours;
GRANT ALL PRIVILEGES ON latech.* TO 'admindev'@'192.168.1.71';

FLUSH PRIVILEGES;

-- Insert users into the utilisateurs table
INSERT INTO utilisateurs (identifiant, mot_de_passe, role) VALUES
('b.elbaramawy', 'latech94@cours', 'adh'),
('i.ferreira', 'latech94@cours', 'adh'),
('a.kourdourli', 'latech94@cours', 'adh'),
('m.bayoko', 'latech94@cours', 'adh'),
('m.defraire', 'latech94@cours', 'adh'),
('n.nadir', 'latech94@cours', 'adh'),
('g.ajax', 'latech94@cours', 'adh'),
('v.loth', 'latech94@cours', 'adh'),
('e.william', 'latech94@cours', 'adh'),
('t.zarhrate', 'latech94@cours', 'adh'),
('l.bahloul', 'latech94@cours', 'adh'),
('m.luwengo', 'latech94@cours', 'adh'),
('c.rouxin', 'latech94@cours', 'adh'),
('a.lisser', 'latech94@cours=+', 'admin'),
('j.velaidomestry', 'latech94@cours=+', 'admin');
('admintech', 'latech94@cours=+', 'admin');

