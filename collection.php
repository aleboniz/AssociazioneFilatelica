<!-- Pagina che mosra l'elenco di tutte le collezioni,
se viene passato il parametro id, allora mostra l'elenco delle collezioni di un socio in particolare -->
<?php
require "libs/dbconnection.php";
$count = $card = 0;

if (isset($_GET['id'])) {
  $isCollection = 1; $id = $_GET['id'];

  try {  // Seleziona le collezioni di un collezionista in particolare

    if (isset($_POST['title'])){
      $titolo = '"%'.$_POST['title'].'%"';
      $sql = "SELECT * FROM prezzoCollezione WHERE collezionista = $id AND titolo LIKE $titolo";
    } else if (isset($_POST['topic'])){
      $tema = '"%'.$_POST['topic'].'%"';
      $sql = "SELECT * FROM prezzoCollezione WHERE collezionista = $id AND tema LIKE $tema";
    } else {
      $sql = "SELECT * FROM prezzoCollezione WHERE collezionista = $id";
    }

    $rs = $dbConnection->query($sql);

  } catch (PDOException $e) {
    die('Errore nella lettura delle collezioni.');
  }

  try {  // Seleziona il nome e il cognome del collezionista

    $sqlName = "SELECT * FROM soci WHERE id = $id";
    $rsName = $dbConnection->query($sqlName);

  } catch (PDOException $e) {
    die('Errore nella lettura dei collezionisti.');
  }

  while($rowName = $rsName->fetch()){
    $title = $rowName['nome'] . " " . $rowName['cognome'];
    break;
  }

} else {
  $isCollection = 0; $title = "Collezioni";
  try {  // Seleziona tutte le collezioni

    if (isset($_POST['title'])){
      $titolo = '"%'.$_POST['title'].'%"';
      $sql = "SELECT p.id, s.nome, s.cognome, p.titolo, p.tema, p.prezzo
              FROM soci s, prezzoCollezione p
              WHERE s.id = p.collezionista AND p.titolo LIKE $titolo";
    } else if (isset($_POST['topic'])){
      $tema = '"%'.$_POST['topic'].'%"';
      $sql = "SELECT p.id, s.nome, s.cognome, p.titolo, p.tema, p.prezzo
              FROM soci s, prezzoCollezione p
              WHERE s.id = p.collezionista AND p.tema LIKE $tema";
    } else {
      $sql = "SELECT p.id, s.nome, s.cognome, p.titolo, p.tema, p.prezzo
              FROM soci s, prezzoCollezione p
              WHERE s.id = p.collezionista";
    }

    $rs = $dbConnection->query($sql);

  } catch (PDOException $e) {
    die('Errore nella lettura delle collezioni.');
  }
}
require "libs/header.php";
?>

<br><h1 class="text-center"><?= $title ?></h1><br>

<?php if($isCollection == 1){ $action = "collection.php?id=".$id;} else { $action = "collection.php"; } ?>
<div>
  <form action="<?= $action ?>" method="post">
    <label><h5>Filtra i risultati per </h5></label>
    <label>titolo:</label>
    <input type="text" name="title" style="width:155px">
    <input type="submit" value="Filtra" class="btn btn-primary">
  </form>
</div>
<div>
  <form action="<?= $action ?>" method="post">
    <label><h5>Filtra i risultati per </h5></label>
    <label>tema:</label>
    <input type="text" name="topic" style="width:155px">
    <input type="submit" value="Filtra" class="btn btn-primary">
  </form>
</div>

<?php while ($row = $rs->fetch()) : ?>
  <?php if($card % 4 == 0): ?> <div class="card-deck"> <?php endif; ?>
    <div class="card text-center" style="width: 25rem;">
      <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['titolo']; ?></div><p></p>
      <div class="card-img-top"> <img src="media/collezione.png" width="200" height="200"> </div>
      <div class="card-body">
        <p><?= $row['tema'] ?></p>
        <p>€ <?= $row['prezzo'] ?></p>
        <?php if($isCollection == 0): ?> <p><?= $row['nome']." ".$row['cognome'] ?></p> <?php endif; ?>
        <a href="poststamp.php?id=<?= $row['id'] ?>" class="btn btn-primary">Guarda di più</a>
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
