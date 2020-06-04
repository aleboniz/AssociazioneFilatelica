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
<br><h1 class="text-center"><?= $collectionTitle ?></h1>

<form action="aCollection.php?id=<?= $id ?>">
  <label for="price">Ordina per prezzo:</label>
  <select name="price" id="price">
    <option value="empty"></option>
    <option value="asc">crescente</option>
    <option value="desc">decrescente</option>
  </select>
  <input type="submit" value="Submit">
</form><br>

<div class="card-deck">
   <?php while ($row = $rs->fetch()) : ?>
     <div class="card text-center" style="width: 18rem;">
       <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['nome']; ?></div><p></p>
       <div class="card-body">

         <?php if($row['immagine'] != ""): ?>  <!-- se è presente il riferimento ad un'immagine, viene caricata -->
           <div class="card-img-top"> <img src="media/<?= $row['immagine'] ?>" width="200" height="200"> </div>
         <?php endif; if($row['immagine'] == ""): ?>  <!-- se non è presente il riferimento ad un'immagine, viene caricata l'icona di default -->
           <div class="card-img-top"> <img src="media/francobollo.png" width="200" height="200"> </div>
         <?php endif; ?>
         <p>
         <p><?= $row['data_emissione'] ?></p>
         <p>€ <?= $row['prezzo'] ?></p>
       </div>
     </div>
    <?php endwhile; ?>
</div><br>

<div class="text-center">
  <h4>Commenti</h4>
  <div>
    <form action="libs/addComment.php" method="post">
      <label style="font-size:18px">Inserisci il tuo commento</label>
      <input type="text" name="comment">
      <input type="submit" value="Commenta" class="btn btn-primary">
    </form>
  </div><br>

  <?php $comment = 0; while ($row = $rsComment->fetch()) : ?>
    <?php if ($comment % 2 == 0) { $class = "bg-secondary"; } else { $class = "bg-light"; } ?>
    <div class="<?= $class; ?>">
      <p><?= $row['commento'] ?></p>
    </div>
   <?php $comment= $comment + 1; endwhile; ?>
</div><br>

<?php require "libs/footer.php"; ?>
