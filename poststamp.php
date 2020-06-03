<?php
session_start();
$title = "Francobolli";
require "libs/header.php";
require "libs/dbconnection.php";


try {  // Seleziona tutti i francobolli della collezione 'collection'

  if (isset($_GET['price']) AND $_GET['price'] != "empty") {  //controllare il filtro del prezzo crescente/decrescente
    if ($_GET['price'] == 'asc') {
      $sql = "SELECT c.titolo, c.id, f.nome, f.prezzo, f.data_emissione, f.immagine
              FROM francobolli f JOIN collezioni c ON f.collezione = c.id
              ORDER BY prezzo ASC";
    } else {
      $sql = "SELECT c.titolo, c.id, f.nome, f.prezzo, f.data_emissione, f.immagine
              FROM francobolli f JOIN collezioni c ON f.collezione = c.id
              ORDER BY prezzo DESC";
    }
  } else {
    $sql = "SELECT c.titolo, c.id, f.nome, f.prezzo, f.data_emissione, f.immagine
            FROM francobolli f JOIN collezioni c ON f.collezione = c.id";
  }

  $rs = $dbConnection->query($sql);

} catch (PDOException $e) {
  die('Errore nella lettura dei francobolli.');
}

?>
<h2>Francobolli</h2>

<form action="poststamp.php?id=<?= $id ?>">
  <label for="price">Ordina per prezzo:</label>
  <select name="price" id="price">
    <option value="empty"></option>
    <option value="asc">crescente</option>
    <option value="desc">decrescente</option>
  </select>
  <input type="submit" value="Submit">
</form>

<div class="form-row">
  <table style="width:100%">
   <tr>
     <th>Nome</th>
     <th>Data emissione</th>
     <th>Prezzo</th>
     <th>Immagine</th>
     <th>Collezione<th>
   </tr>
   <?php while ($row = $rs->fetch()) : ?>
     <tr>
       <td><?= $row['nome'] ?></td>
       <td><?= $row['data_emissione'] ?></td>
       <td>€ <?= $row['prezzo'] ?></td>

       <?php if($row['immagine'] != ""): ?>  <!-- se è presente il riferimento ad un'immagine, viene caricata -->
         <td> <img src="media/<?= $row['immagine'] ?>" width="200" height="200"> </td>
       <?php endif; if($row['immagine'] == ""): ?>  <!-- se non è presente il riferimento ad un'immagine, viene caricata l'icona di default -->
         <td> <img src="media/francobollo.png" width="200" height="200"> </td>
       <?php endif; ?>

       <td><a href="collection.php?id=<?= $row['id'] ?>"><?= $row['titolo'] ?></a></td>
     </tr>
    <?php endwhile; ?>
  </table>

</div>
<?php require "libs/footer.php"; ?>
