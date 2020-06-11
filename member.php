<!-- Pagina che mosra l'elenco dei soci-->
<?php
require "libs/dbconnection.php";
$title = "Soci collezionisti";
require "libs/header.php";
$card = 0;

try {  // Seleziona tutti i collezionisti

  $sql = "SELECT * FROM soci";
  $rs = $dbConnection->query($sql);

} catch (PDOException $e) {
  die('Errore nella lettura dei collezionisti.');
}
?>

<br><h1 class="text-center">Soci</h1><br>
   <?php while ($row = $rs->fetch()) : ?>
       <?php if($card % 3 == 0): ?> <div class="card-deck"> <?php endif; ?>
         <div class="card text-center" style="width: 18rem;">
           <div class="card-header" style="text-align: center;font-size:23px"><?php echo $row['nome']." ".$row['cognome']; ?></div><p></p>

           <?php if($row['genere'] == "M"): ?>  <!-- se è presente il riferimento ad un'immagine, viene caricata -->
            <div class="card-img-top"> <img src="media/uomo.png" width="200" height="200"> </div>
          <?php endif; if($row['genere'] == "F"): ?>  <!-- se non è presente il riferimento ad un'immagine, viene caricata l'icona di default -->
            <div class="card-img-top"> <img src="media/donna.png" width="200" height="200"> </div>
           <?php endif; ?>

           <div class="card-body"> <a href="collection.php?id=<?= $row['id']?>" class="btn btn-primary">Guarda di più</a> </div>
         </div>
       <?php if($card % 3 == 2): ?> </div><br> <?php endif; ?>
    <?php $card = $card + 1; endwhile; ?>
<br><br>

<?php require "libs/footer.php"; ?>
