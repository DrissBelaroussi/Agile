DROP DATABASE IF EXISTS agile;

CREATE DATABASE agile;
use agile;

DROP TABLE IF EXISTS Medecin CASCADE;
CREATE TABLE Medecin(
		idMedecin INTEGER PRIMARY KEY AUTO_INCREMENT,
		nomMedecin varchar(50) NOT NULL,
		prenomMedecin varchar(50),
		dateNaissance date NOT NULL,
		adresseCabinet varchar(50) NOT NULL,
		villeCabinet varchar(50) NOT NULL,
		cpCabinet char(5) NOT NULL,
		tel char(14) NOT NULL,
		mail varchar(50) NOT NULL,
		login varchar(20) NOT NULL,
		mdp varchar(20) NOT NULL
	);

DROP TABLE IF EXISTS Patient CASCADE;	
CREATE TABLE Patient(
		idPatient INTEGER PRIMARY KEY AUTO_INCREMENT,
		nomPatient varchar(50) NOT NULL,
		prenomPatient varchar(50),
		dateNaissance date NOT NULL,
		adresse varchar(50) NOT NULL,
		ville varchar(50) NOT NULL,
		cp char(5) NOT NULL,
		tel char(14) NOT NULL,
		mail varchar(50) NOT NULL,
		login varchar(20) NOT NULL,
		mdp varchar(20) NOT NULL
	);

DROP TABLE IF EXISTS CompteRendu CASCADE;	
CREATE TABLE CompteRendu(
		idCompteRendu INTEGER NOT NULL AUTO_INCREMENT,
		idPatient INTEGER NOT NULL,
		idMedecin INTEGER NOT NULL,
		contenuCompteRendu varchar(500) NOT NULL,
		PRIMARY KEY(idCompteRendu, idPatient, idMedecin)
	);	

DROP TABLE IF EXISTS RDV CASCADE;	
CREATE TABLE RDV(
		dateRDV date NOT NULL,
		idPatient INTEGER NOT NULL,
		idMedecin INTEGER NOT NULL,
		etat varchar(2) NOT NULL,
		PRIMARY KEY(dateRDV, idPatient, idMedecin)
	);	

DROP TABLE IF EXISTS Message CASCADE;
CREATE TABLE Message(
		idMessage INTEGER NOT NULL AUTO_INCREMENT,
		idPatient INTEGER NOT NULL,
		idMedecin INTEGER NOT NULL,
		dateMessage date NOT NULL,
		objetMessage varchar(50) NOT NULL,
		contenuMessage varchar(500) NOT NULL,
		PRIMARY KEY(idMessage, idPatient, idMedecin)
	);	
	

ALTER TABLE CompteRendu ADD CONSTRAINT fk_CR_Medecin FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin);	
ALTER TABLE CompteRendu ADD CONSTRAINT fk_CR_Patient FOREIGN KEY (idPatient) REFERENCES Patient(idPatient);

ALTER TABLE RDV ADD CONSTRAINT fk_RDV_Medecin FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin);
ALTER TABLE RDV ADD CONSTRAINT fk_RDV_Patient FOREIGN KEY (idPatient) REFERENCES Patient(idPatient);

ALTER TABLE Message ADD CONSTRAINT fk_Message_Medecin FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin);
ALTER TABLE Message ADD CONSTRAINT fk_Message_Patient FOREIGN KEY (idPatient) REFERENCES Patient(idPatient);


INSERT INTO Medecin VALUES (1, 'DUBOIT', 'Benoit', '1959-02-16', '152 boulevard des fleurs', 'Paris', '75016', '06-54-85-97-63', 'benoit.duboit@gmail.com', 'bduboit', 'azerty');

INSERT INTO Patient VALUES (1, 'Bellard', 'Anne', '1985-06-25', '30 rue des paquerettes', 'Paris', '75018', '06-52-65-94-78', 'anne.bellard@gmail.com', 'abellard', 'azerty');

INSERT INTO CompteRendu VALUES (1, 1, 1, 'Anne va mieux');

INSERT INTO RDV VALUES ('2017-11-10', 1, 1, 'A');

INSERT INTO Message VALUES (1, 1, 1, '2017-11-08', 'Question', 'Bonjour monsieur Duboit, [...] Cordialement, BELLARD Anne');



	
	