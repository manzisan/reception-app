<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="img/icon.jpg">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/callsub.css">
<link rel="stylesheet" type="text/css" href="css/button.css">
<title>受付</title>
</head>
<script>
  $(window).on('touchmove.noScroll', function(e) {
    e.preventDefault();
  });
</script>
<body>
<div id="wrapper">

  <h1><?php echo $company ?><br><?php echo $visitor ?> 様<br>ようこそお越しくださいました。</h1>

    <div class="member">
      <img src="./img/member/
      <?php
        echo $id;
      ?>.jpg">
      <p class="division"><?php echo $div ?></p>
      <small><?php echo $kana ?></small>
      <p class="name"><?php echo $name ?></p>

    </div>

    <p class="calltext">以上の内容でよろしければ呼び出してください。</p>
    <form action="waitsub.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <input type="hidden" name="company" value="<?php echo $company?>">
      <input type="hidden" name="visitor" value="<?php echo $visitor?>">
      <input type="submit" class="call" value="呼び出す">
      <a href="list.php" class="back">戻る</a>
    </form>
</div>
</body>
</html>
