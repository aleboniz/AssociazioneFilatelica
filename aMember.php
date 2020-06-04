<?php
session_start();
require "libs/dbconnection.php";
$count = 0;
$id = $_GET['id'];

try {  // Seleziona tutti i collezionisti

  $sql = "SELECT * FROM prezzoCollezione WHERE collezionista = $id";
  $rs = $dbConnection->query($sql);

} catch (PDOException $e) {
  die('Errore nella lettura dei collezionisti.');
}

try {  // Seleziona il nome e il cognome del collezionista

  $sqlName = "SELECT * FROM collezionisti WHERE id = $id";
  $rsName = $dbConnection->query($sqlName);

} catch (PDOException $e) {
  die('Errore nella lettura dei collezionisti.');
}

while($rowName = $rsName->fetch()){
  $title = $rowName['nome'] . " " . $rowName['cognome'];
  break;
}
require "libs/header.php";
?>

<br><h1 class="text-center"><?= $title ?></h1><br>
<div class="card-deck">
   <?php while ($row = $rs->fetch()) : ?>
     <div class="card text-center" style="width: 18rem;">
       <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['titolo']; ?></div><p></p>
       <div class="card-img-top"> <img src="media/collezione.png" width="200" height="200"> </div>
       <div class="card-body">
         <p><?= $row['tema'] ?></p>
         <p>€ <?= $row['prezzo'] ?></p>
         <a href="aCollection.php?id=<?= $row['id'] ?>" class="btn btn-primary">Guarda di più</a>
       </div>
     </div>
     <?php $count = $count + 1; ?>
    <?php endwhile; ?>
</div><br>

<div>
  <?php if($count == 0): ?>
    <p>Non abbiamo trovato alcun risultato.</p>
  <?php endif; ?>
</div>

<?php require "libs/footer.php"; ?>
