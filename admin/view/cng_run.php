<?php
  include("../../dbconnection/config.php");
  include("../../dbconnection/connect.php");


  $stmt = $pdo -> prepare('update schedule set date = :date, hours = :hours, minutes = :minutes, company = :company, customer = :customer, employee = :employee where code = :code');

  $stmt -> bindParam(':date', $_POST["date"], PDO::PARAM_STR);
  $stmt -> bindValue(':hours', $_POST["hours"], PDO::PARAM_INT);
  $stmt -> bindValue(':minutes', $_POST["minutes"], PDO::PARAM_INT);
  $stmt -> bindParam(':company', $_POST["company"], PDO::PARAM_STR);
  $stmt -> bindParam(':customer', $_POST["customer"], PDO::PARAM_STR);
  $stmt -> bindParam(':employee', $_POST["employee"], PDO::PARAM_STR);
  $stmt -> bindParam(':code', $_POST["code"], PDO::PARAM_STR);
  $stmt -> execute();

  header('Location: index.php');
  exit;
