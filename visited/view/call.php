<?php
  include("../../dbconnection/config.php");
  include("../../dbconnection/connect.php");

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
    header("Location: recepcode.php?error=1");
  }

  $title = "呼び出し";
  include_once "../layout/meta.php";
?>
<body>
  <div id="wrapper">
    <h1><?php echo $company ?><br><?php echo $customer ?> 様<br>ようこそお越しくださいました。</h1>
    <div class="member">
      <img src="../src/img/member/<?php echo $id != 0 ? $id : 0 ?>.jpg">
      <p><?php echo $div ?></p>
      <p><?php echo $kana ?></p>
      <p><?php echo $name;?></p>
    </div>
    <p class="calltext">以上の内容でよろしければ呼び出してください。</p>
    <form action="wait.php" method="post" id="form">
      <input type="hidden" name="code" value="<?php echo $code ?>">
    </form>
    <div class="footer-btn-list">
      <button onClick="location.href='recepcode.php'" class="back">戻る</button>
      <button onclick="$('#form').submit();" class="next">呼び出す</button>
    </div>
  </div>
</body>
</html>
