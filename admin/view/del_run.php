<?php
  include("../../dbconnection/config.php");
  

  $id = $_POST["id"];

  $stmt = $pdo -> prepare('delete from schedule where id = :delete_id');
  $stmt -> bindParam(':delete_id', $id, PDO::PARAM_INT);

  $stmt -> execute();

  header('Location: index.php');
  exit;
