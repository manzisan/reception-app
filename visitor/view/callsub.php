<?php
  include("../../dbconnection/config.php");

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

  $title = "呼び出し";
  include_once "../layout/meta.php";
?>
<body>
  <div id="wrapper">
    <h1><?php echo $company; ?><br><?php echo $visitor; ?> 様<br>ようこそお越しくださいました。</h1>

    <div class="member">
      <img src="../src/img/member/<?php echo $id; ?>.jpg">
      <p class="division"><?php echo $div; ?></p>
      <p><?php echo $kana; ?></p>
      <p class="name"><?php echo $name; ?></p>a
    </div>

    <p class="calltext">以上の内容でよろしければ呼び出してください。</p>
    <form action="waitsub.php" method="post" id="form">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <input type="hidden" name="company" value="<?php echo $company?>">
      <input type="hidden" name="visitor" value="<?php echo $visitor?>">
    </form>
    <div class="footer-btn-list">
      <button onClick="location.href='list.php'" class="back">戻る</button>
      <button onclick="$('#form').submit();" class="next">呼び出す</button>
    </div>
  </div>
</body>
</html>
