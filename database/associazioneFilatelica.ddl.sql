DROP DATABASE IF EXISTS associazioneFilatelica;
CREATE DATABASE associazioneFilatelica;
USE associazioneFilatelica;

CREATE TABLE collezionista(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(30) NOT NULL,
  cognome VARCHAR(30) NOT NULL
);

CREATE TABLE collezioni(
  id INT PRIMARY KEY AUTO_INCREMENT,
  titolo VARCHAR(50) NOT NULL,
  collezionista INT NOT NULL,
  tema VARCHAR(30) NOT NULL,
  FOREIGN KEY(collezionista) REFERENCES collezionista(id)
);

CREATE TABLE francobolli(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  collezione INT NOT NULL,
  data_emissione DATE NOT NULL,
  prezzo FLOAT NOT NULL,
  immagine VARCHAR(50),
  FOREIGN KEY(collezione) REFERENCES collezioni(id)
);

CREATE TABLE commenti(
  id INT PRIMARY KEY AUTO_INCREMENT,
  collezione INT NOT NULL,
  commento VARCHAR(100) NOT NULL,
  FOREIGN KEY(collezione) REFERENCES collezioni(id)
);

-- visualizzare il prezzo di ciascuna collezione (sommando i prezzi di ogni francobollo contenuto nella collezione)
CREATE OR REPLACE VIEW prezzoCollezione AS
SELECT c.id, round(sum(f.prezzo), 2) as prezzo
FROM collezioni c, francobolli f
WHERE c.id = f.collezione
GROUP BY c.id;
