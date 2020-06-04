<?php
$title = "Associazione filatelica";
require "libs/header.php";
require "libs/dbconnection.php";
$count = 0;

try {  // Seleziona tutte le collezioni

  if (isset($_GET['price']) AND $_GET['price'] != "empty") {  //controllare il filtro del prezzo crescente/decrescente
    if ($_GET['price'] == 'asc') {
      $sql = "SELECT c.id, cl.nome, cl.cognome, c.titolo, c.tema, p.prezzo
              FROM collezionisti cl, collezioni c, prezzoCollezione p
              WHERE cl.id = c.collezionista AND c.id = p.id
              ORDER BY p.prezzo ASC";
    } else {
      $sql = "SELECT c.id, cl.nome, cl.cognome, c.titolo, c.tema, p.prezzo
              FROM collezionisti cl, collezioni c, prezzoCollezione p
              WHERE cl.id = c.collezionista AND c.id = p.id
              ORDER BY p.prezzo DESC";
    }
  } else if (isset($_GET['topic'])){
    $tema = $_GET['topic'];
    $sql = "SELECT c.id, cl.nome, cl.cognome, c.titolo, c.tema, p.prezzo
            FROM collezionisti cl, collezioni c, prezzoCollezione p
            WHERE cl.id = c.collezionista AND c.id = p.id AND c.tema LIKE '%".$tema."%'";
  } else {
    $sql = "SELECT c.id, cl.nome, cl.cognome, c.titolo, c.tema, p.prezzo
            FROM collezionisti cl, collezioni c, prezzoCollezione p
            WHERE cl.id = c.collezionista AND c.id = p.id";
  }

  $rs = $dbConnection->query($sql);

} catch (PDOException $e) {
  die('Errore nella lettura delle collezioni.');
}
?>
<h2>Collezioni</h2><br>

<div>
  <form action"">
    <label><h5>Filtra i risultati</h5></label>
    <label>tema:</label>
    <input type="text" name="topic" style="width:155px">
    <input type="submit" value="filtra">
  </form>
</div>
<div>
  <form action="">
    <label><h5>Ordina i risultati</h5></label>
    <label>prezzo:</label>
    <select name="price" id="price">
      <option value="empty"></option>
      <option value="asc">crescente</option>
      <option value="desc">decrescente</option>
      <input type="submit" value="ordina">
    </select>
  </form>
</div><br>

<div class="form-row">
  <table style="width:100%">
   <tr>
     <th>Titolo</th>
     <th>Tema</th>
     <th>Prezzo</th>
     <th>Nome</th>
     <th>Cognome</th>
   </tr>
   <?php while ($row = $rs->fetch()) : ?>
     <tr>
       <td> <a href="collection.php?id=<?= $row['id'] ?>"> <?= $row['titolo'] ?> </a> </td>
       <td><?= $row['tema'] ?></td>
       <td>€ <?= $row['prezzo'] ?></td>
       <td><?= $row['nome'] ?></td>
       <td><?= $row['cognome'] ?></td>
     </tr>
     <?php $count = $count + 1; ?>
    <?php endwhile; ?>
  </table>

  <?php if($count == 0): ?>
    <p>Non abbiamo trovato alcun risultato.</p>
  <?php endif; ?>

</div>
<?php require "libs/footer.php"; ?>
