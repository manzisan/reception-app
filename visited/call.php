<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $code = $_POST["code"];

  $sql = $pdo->prepare('SELECT id, name,kana,division FROM employee where id in (select employee from schedule where code = "'.$code.'") ');
  $sql -> execute();
  while($employee = $sql -> fetch(PDO::FETCH_ASSOC)){
    $id = $employee["id"];
    $div = $employee["division"]; //部門
    $name = $employee["name"]; //名前
    $kana = $employee["kana"]; //フリガナ
    // $nickname = $employee["nickname"]; //ニックネーム
    // $cid = $employee["cid"]; //chatwork id
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
    header("Location: recepcode.php?error=1");
  }

  $title = "呼び出し";
  include_once "layout/meta.php";
?>
<body>
  <div id="wrapper">
    <h1><?php echo $company ?><br><?php echo $customer ?> 様<br>ようこそお越しくださいました。</h1>
    <div class="member">
      <img src="./img/member/<?php $id == 0 ? echo $id : echo 0 ?>.jpg" alt="member">
      <p class="division"><?php echo $div ?></p>
      <small><?php echo $kana ?></small>
      <p><?php echo $name;?></p>
    </div>
    <p class="calltext">以上の内容でよろしければ呼び出してください。</p>
    <form action="wait.php" method="post">
      <input type="hidden" name="code" value="<?php echo $code ?>">
      <input type="submit" class="call" value="呼び出す">
    </form>
  </div>
  <div class="a_list">
    <a href="recepcode.php" class="back">戻る</a>
  </div>
</body>
</html>
