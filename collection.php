<?php
$title = "Collezioni";
require "libs/header.php";
require "libs/dbconnection.php";
$count = $card = 0;

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
<br><h1 class="text-center">Collezioni</h1><br>

<div>
  <form action"">
    <label><h5>Filtra i risultati</h5></label>
    <label>tema:</label>
    <input type="text" name="topic" style="width:155px">
    <input type="submit" value="Filtra" class="btn btn-primary">
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
      <input type="submit" value="Ordina" class="btn btn-primary">
    </select>
  </form>
</div><br>


<?php while ($row = $rs->fetch()) : ?>
  <?php if($card % 4 == 0): ?> <div class="card-deck"> <?php endif; ?>
    <div class="card text-center" style="width: 25rem;">
      <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['titolo']; ?></div><p></p>
      <div class="card-img-top"> <img src="media/collezione.png" width="200" height="200"> </div>
      <div class="card-body">
        <p><?= $row['tema'] ?></p>
        <p>€ <?= $row['prezzo'] ?></p>
        <p><?= $row['nome']." ".$row['cognome'] ?></p>
        <a href="aCollection.php?id=<?= $row['id'] ?>" class="btn btn-primary">Guarda di più</a>
      </div>
    </div>
  <?php if($card % 4 == 3): ?> </div><br> <?php endif; ?>
<?php $card = $card + 1; $count = $count + 1; endwhile; ?>
</div><br><br>

<div>
  <?php if($count == 0): ?>
    <p>Non abbiamo trovato alcun risultato.</p>
  <?php endif; ?>
</div>

<?php require "libs/footer.php"; ?>
