<?php
session_start();
require "libs/dbconnection.php";


if (isset($_GET['id'])) {
  $id = $_SESSION['id'] = $_GET['id'];
} else {
  $id = $_SESSION['id'];
}

try {  // Seleziona tutti i francobolli della collezione $id

  if (isset($_GET['price']) AND $_GET['price'] != "empty") {  //controllare il filtro del prezzo crescente/decrescente
    if ($_GET['price'] == 'asc') {
      $sql = "SELECT * FROM francobolli WHERE collezione = $id ORDER BY prezzo ASC";
    } else {
      $sql = "SELECT * FROM francobolli WHERE collezione = $id ORDER BY prezzo DESC";
    }
  } else {
    $sql = "SELECT * FROM francobolli WHERE collezione = $id";
  }

  $rs = $dbConnection->query($sql);


  $sqlTitle = "SELECT titolo FROM collezioni WHERE id = $id";
  $rsTitle = $dbConnection->query($sqlTitle);
  while ($rowTitle = $rsTitle->fetch()){
    $collectionTitle = $rowTitle['titolo'];
    break;
  }

} catch (PDOException $e) {
  die('Errore nella lettura dei francobolli.');
}
$title = $collectionTitle;
require "libs/header.php";

try {  // Seleziona tutti i commenti della collezione $id

  $sqlComment = "SELECT commento FROM commenti WHERE collezione = $id ORDER BY id DESC";
  $rsComment = $dbConnection->query($sqlComment);

} catch (PDOException $e) {
  die('Errore nella lettura dei commenti.');
}
?>
<h2 class="text-center"><?= $collectionTitle ?></h2>

<form action="collection.php?id=<?= $id ?>">
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

     </tr>
    <?php endwhile; ?>
  </table>
</div><br>

<div class="text-center">
  <h4>Commenti</h4>
  <div>
    <form action="libs/addComment.php" method="post">
      <label>Inserisci il tuo commento</label>
      <input type="text" name="comment">
      <input type="submit" value="commenta">
    </form>
  <div>

  <?php while ($row = $rsComment->fetch()) : ?>
      <p><?= $row['commento'] ?></p>
   <?php endwhile; ?>
</div>
<?php require "libs/footer.php"; ?>
