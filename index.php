<?php
$title = "Home";
require "libs/header.php";
?>

<br><h1 class="text-center">Associazione filatelica</h2>
<br><br>
<div class="card-deck">
  <div class="card text-center" style="width: 25rem;">
    <div class="card-header" style="text-align: center;font-size:23px">SOCI</div><p></p>
    <div class="card-img-top"> <img src="media/uomo.png" width="200" height="200"> </div><p></p>
    <div class="card-body"> <p>Guarda tutti i soci</p> <a href="member.php" class="btn btn-primary">Vai</a> </div>
  </div>
  <br>
  <div class="card text-center" style="width: 25rem;">
    <div class="card-header" style="text-align: center;font-size:23px">COLLEZIONI</div><p></p>
    <div class="card-img-top"> <img src="media/collezione.png" width="200" height="200"> </div><p></p>
    <div class="card-body"> <p>Guarda tutte le collezioni</p> <a href="collection.php" class="btn btn-primary">Vai</a> </div>
  </div>
  <br>
  <div class="card text-center" style="width: 25rem;">
    <div class="card-header" style="text-align: center;font-size:23px">FRANCOBOLLI</div><p></p>
    <div class="card-img-top"> <img src="media/francobollo.png" width="200" height="200"> </div><p></p>
    <div class="card-body"> <p>Guarda tutti i francobolli</p> <a href="poststamp.php" class="btn btn-primary">Vai</a> </div>
  </div>
  <br>
</div><br>

<?php require "libs/footer.php"; ?>
