USE associazioneFilatelica;


  -- 1) Selezionare, per ciascuna collezione, il titolo, il tema, il prezzo, il nome e il cognome del collezionista

-- visualizzare il prezzo di ciascuna collezione (sommando i prezzi di ogni francobollo contenuto nella collezione)
CREATE OR REPLACE VIEW prezzoCollezione AS
SELECT c.id, c.titolo, c.collezionista, c.tema, round(sum(f.prezzo), 2) as prezzo
FROM collezioni c, francobolli f
WHERE c.id = f.collezione
GROUP BY c.id;

SELECT p.titolo, p.id, c.nome, c.cognome, p.tema, p.prezzo
FROM collezionisti c, prezzoCollezione p
WHERE c.id = p.collezionista;



  -- 2) Cercare i commenti per una collezione in particolare
  --    a scopo esemplificativo, si visualizzano i commenti della collezione con 'id' = 6

SELECT cm.commento
FROM collezioni c JOIN commenti cm ON c.id = cm.collezione
WHERE cm.collezione = 6;
