USE associazioneFilatelica;


  -- 1) Selezionare, per ciascuna collezione, il titolo, il tema, il prezzo, il nome e il cognome del collezionista

-- prezzo per ciascuna collezione
CREATE OR REPLACE VIEW prezzoCollezione AS
SELECT c.id, round(sum(f.prezzo), 2) as prezzo
FROM collezioni c, francobolli f
WHERE c.id = f.collezione
GROUP BY c.id;


SELECT c.titolo, cl.nome, cl.cognome, c.tema, p.prezzo
FROM collezionisti cl, collezioni c, prezzoCollezione p
WHERE cl.id = c.collezionista AND c.id = p.id;



  -- 2) Cercare i commenti per una collezione in particolare
  --    a scopo esemplificativo, si visualizzano i commenti della collezione con 'id' = 6

SELECT cm.commento
FROM collezioni c JOIN commenti cm ON c.id = cm.collezione
WHERE cm.collezione = 6;
