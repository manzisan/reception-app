<?php
  $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
  $url = pathinfo($url);

  switch ($url["filename"]) {
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
    case "callsub":
      $id = $_POST["emplist"];
      $company = $_POST["company"];
      $visitor = $_POST["name"];

      $sql = $pdo->prepare('SELECT division, name, kana, nickname FROM employee where id = "'.$id.'"');
      $sql -> execute();
      while($employee = $sql -> fetch(PDO::FETCH_ASSOC)){
        $div = $employee["division"];
        $name = $employee["name"];
        $kana = $employee["kana"];
        $nickname = $employee["nickname"];
      }
      break;
    case "list":
      $company = $_POST["company"];
      $name = $_POST["name"];

      $sql = $pdo->prepare('SELECT name,nickname,id,kana,division FROM employee order by kana asc');

      $sql -> execute();
      $friends = [];
      while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        array_push($friends, $row);
        $id = $row["id"];
      }
      $count = $sql -> rowCount();
      break;
    case "wait":
      $code = $_POST["code"];
      $sql = $pdo -> prepare('SELECT company, customer from schedule where code = "'.$code.'"');
      $sql -> execute();
      while($visitor = $sql -> fetch(PDO::FETCH_ASSOC)){
        $company = $visitor["company"];
        $customer = $visitor["customer"];
      }

      $url = [
        "https://discordapp.com/api/webhooks/379591248060743682/00-s1mAkyOvsacbgiSrKTvcUD2yaYnuqqHuXl_hfZImOSBfM6nIejfFjsfKecWwvFXHa",

        "https://discordapp.com/api/webhooks/379596931443458048/TEC3oEJTmXmtx6-YquaYuDZ5TKPI_ciIb2CqIOv1NCLBligodr24Yb8x6NLvi7oPqgaM"
      ];

      $option = [
        "content" => $company."の".$customer."様がお見えになられています。"
      ];

      foreach ($url as $val) {
        $ch = curl_init();
        curl_setopt_array($ch, [
          CURLOPT_URL => $val,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => http_build_query($option),
        ]);
        $response = curl_exec($ch);
      }

      curl_close($ch);

      $sql = $pdo -> prepare('delete from schedule where code = "'.$code.'"');
      $sql -> execute();
      break;
    default:
      break;
  }