USE associazioneFilatelica;

INSERT INTO collezioni(titolo, tema) VALUE
  ("Olimpiadi 1960", "sport"),
  ("Hollywood", "cinema"),
  ("Mondiali di Calcio 1990", "sport"),
  ("Pop Art", "arte"),
  ("Storia francese", "storia"),
  ("Regno d'Italia", "storia");

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
  ("Nazionale Inghilterra", 3, '1990-07-08', 3.80, null);

INSERT INTO commenti(collezione, commento) VALUE
  (3, "poco completa"),
  (5, "molto interessante e accurata"),
  (6, "molto bella"),
  (1, "molto accurata"),
  (6, "molto interessante");
