USE associazioneFilatelica;

INSERT INTO soci(nome, cognome, genere) VALUE
  ("Mario", "Guanciale", "M"),
  ("Luigi", "Serniotti", "M"),
  ("Sara", "Bonifacio", "F"),
  ("Michele", "Franceschini", "M"),
  ("Lucia", "Quaranta", "F"),
  ("Andrea", "Vettori", "M");

INSERT INTO collezioni(titolo, collezionista, tema) VALUE
  ("Olimpiadi 1960", 1, "sport"),
  ("Hollywood", 2, "cinema"),
  ("Mondiali di Calcio 1990", 3, "sport"),
  ("Pop Art", 4, "arte"),
  ("Storia francese", 5, "storia"),
  ("Regno d'Italia", 6, "storia"),
  ("Auto d'epoca", 3, "automobili"),
  ("Computer d'epoca", 5, "tecnologia");

INSERT INTO francobolli(nome, collezione, data_emissione, prezzo, immagine) VALUE
  ("Equitazione", 1, '1960-09-11', 6.80, "equitazione.jpg"),
  ("Canottaggio", 1, '1960-09-09', 2.70, "canottaggio.png"),
  ("Marilyn Monroe", 2, '1992-02-01', 4.60, "marilyn_monroe.jpg"),
  ("Nazionale tedesca", 3, '1990-07-08', 3.80, null),
  ("Andy Warhol", 4, '1996-01-23', 4.00, "andy_warhol.jpg"),
  ("Napoleone Bonaparte", 5, '1862-01-01', 3.80, "napoleone_bonaparte.jpg"),
  ("Re Luigi XV", 5, '1968-03-20', 5.60, null),
  ("Vittorio Emanuele III di Savoia", 6, '1926-05-02', 2.30, "Vittorio_Emanuele_III_di_Savoia.jpg"),
  ("Nazionale Argentina", 3, '1990-07-08', 3.80, null),
  ("Nazionale Italia", 3, '1990-07-08', 3.80, null),
  ("Nazionale Inghilterra", 3, '1990-07-08', 3.80, null),
  ("Cadillac Eldorado", 7, '1985-02-05', 6.80, "cadillac.png"),
  ("Fiat 1", 7, '1985-03-01', 3.80, "fiat.png"),
  ("Steyr 50 austriaca", 7, '1999-07-20', 3.80, null),
  ("Olivetti", 8, '1998-10-27', 3.80, "olivetti.jpeg");

INSERT INTO commenti(collezione, commento) VALUE
  (3, "poco completa"),
  (5, "molto interessante e accurata"),
  (6, "molto bella"),
  (1, "molto accurata"),
  (6, "molto interessante");
