<!-- Pagina che mosra l'elenco di tutti i francobolli,
se viene passato il parametro id, allora mostra l'elenco dei francobolli di una collezione in particolare,
                                                            alla quale è possibile aggiungere un commento -->
<?php
require "libs/dbconnection.php";
$card = 0;

if (isset($_GET['id'])){
  $isPoststamp = 1; $id = $_GET['id'];
  try {  // Seleziona tutti i francobolli della collezione $id

    if (isset($_POST['price']) AND $_POST['price'] != "empty") {  //controlla il filtro del prezzo crescente/decrescente
      if ($_POST['price'] == 'asc') {
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
    $title = $collectionTitle;

  } catch (PDOException $e) {
    die('Errore nella lettura dei francobolli.');
  }

  try {  // Seleziona tutti i commenti della collezione $id

    $sqlComment = "SELECT commento FROM commenti WHERE collezione = $id ORDER BY id DESC";
    $rsComment = $dbConnection->query($sqlComment);

  } catch (PDOException $e) {
    die('Errore nella lettura dei commenti.');
  }

} else {
  $isPoststamp = 0; $title = "Francobolli";
  try {  // Seleziona tutti i francobolli presenti nel sistema

    if (isset($_POST['price']) AND $_POST['price'] != "empty") {  //controlla il filtro del prezzo crescente/decrescente
      if ($_POST['price'] == 'asc') {
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
}
require "libs/header.php";
?>

<br><h1 class="text-center"><?= $title ?></h1><br>

<form action="" method="post">
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
        <?php if($isPoststamp == 0): ?>
          <p><?= $row['titolo'] ?></p>
          <a href="poststamp.php?id=<?= $row['id'] ?>" class="btn btn-primary">Guarda tutta la collezione</a>
        <?php endif; ?>
      </div>
    </div>
  <?php if($card % 5 == 4): ?> </div><br> <?php endif; ?>
<?php $card = $card + 1; endwhile; ?>
</div><br>

<?php if($isPoststamp == 1): ?>
  <div class="text-center">
    <h4>Commenti</h4>
    <div>
      <form action="libs/addComment.php?id=<?= $id ?>" method="post">
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
  </div>
<?php endif; ?><br>

<?php require "libs/footer.php"; ?>
