<?php
session_start();
require "dbconnection.php";

if (isset($_POST['comment'])) {
  $comment = $_POST['comment'];
  $id = $_GET['id'];
  try {
    $sql = "INSERT INTO commenti(collezione, commento) VALUES(:collezione, :commento)";
    $statement = $dbConnection->prepare($sql);
    $statement->execute(["collezione" => $id, "commento" => $comment ]);
  } catch (PDOException $e) {
    die("Errore nell'inserimento del commento.");
  }
}
header("location: ../poststamp.php?id=".$id);
?>
