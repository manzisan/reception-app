<?php
  $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
  $url = pathinfo($url);

  switch ($url["filename"]) {
    case "recep-code":
      $test = "a";
      break;
    case "call":
      $code = $_POST["code"];
      $sql = $pdo->prepare('SELECT id, name,kana,division FROM employee where id in (select employee from schedule where code = "'.$code.'") ');
      $sql -> execute();
      while($employee = $sql -> fetch(PDO::FETCH_ASSOC)){
        $id = $employee["id"];
        $div = $employee["division"];
        $name = $employee["name"];
        $kana = $employee["kana"];
      }
      $sql = $pdo->prepare('SELECT company, customer from schedule where code = "'.$code.'"');
      $sql2 = $pdo->prepare('SELECT company, customer from schedule where code = "'.$code.'"');
      $sql -> execute();
      while($visitor = $sql -> fetch(PDO::FETCH_ASSOC)){
        $company = $visitor["company"];
        $customer = $visitor["customer"];
      }
      $sql2 -> execute();
      $resultSet = $sql2->fetchAll();
      $resultNum = count($resultSet);

      if ($resultNum == 0){
        header("Location: recep-code.php?error=1");
      }
      break;
    default:
      # code...
      break;
  }