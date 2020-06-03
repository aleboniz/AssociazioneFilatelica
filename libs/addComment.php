<?php
session_start();
require "dbconnection.php";

if (isset($_POST['comment'])) {
  $comment = $_POST['comment'];

  try {
    $sql = "INSERT INTO commenti(collezione, commento) VALUES(:collezione, :commento)";
    $statement = $dbConnection->prepare($sql);
    $statement->execute(["collezione" => $_SESSION['id'], "commento" => $comment ]);
  } catch (PDOException $e) {
    die("Errore nell'inserimento del commento.");
  }
}
header("location: ../collection.php");
?>
