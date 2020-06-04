<?php
session_start();
$title = "Francobolli";
require "libs/header.php";
require "libs/dbconnection.php";
$card = 0;

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
<br><h1 class="text-center">Francobolli</h1><br>

<form action="poststamp.php?id=<?= $id ?>">
  <label for="price">Ordina per prezzo:</label>
  <select name="price" id="price">
    <option value="empty"></option>
    <option value="asc">crescente</option>
    <option value="desc">decrescente</option>
  </select>
  <input type="submit" value="Ordina" class="btn btn-primary">
</form><br>

<?php while ($row = $rs->fetch()) : ?>
  <?php if($card % 5 == 0): ?> <div class="card-deck"> <?php endif; ?>
    <div class="card text-center" style="width: 50rem;">
     <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['nome']; ?></div><p></p>

        <?php if($row['immagine'] != ""): ?>  <!-- se è presente il riferimento ad un'immagine, viene caricata -->
         <div class="card-img-top"> <img src="media/<?= $row['immagine'] ?>" width="200" height="200"> </div>
        <?php endif; if($row['immagine'] == ""): ?>  <!-- se non è presente il riferimento ad un'immagine, viene caricata l'icona di default -->
         <div class="card-img-top"> <img src="media/francobollo.png" width="200" height="200"> </div>
        <?php endif; ?>

      <div class="card-body">
        <p><?= $row['data_emissione'] ?></p>
        <p>€ <?= $row['prezzo'] ?></p>
        <p><?= $row['titolo'] ?></p>

        <a href="aCollection.php?id=<?= $row['id'] ?>" class="btn btn-primary">Guarda tutta la collezione</a>
      </div>
    </div>
  <?php if($card % 5 == 4): ?> </div><br> <?php endif; ?>
<?php $card = $card + 1; endwhile; ?>
</div><br><br>

<?php require "libs/footer.php"; ?>
