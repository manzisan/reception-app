<?php
  include("../../dbconnection/config.php");
  include("../../dbconnection/connect.php");

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

  $title = "呼び出し中";
  include_once "../layout/meta.php";
?>
<body id="wait">
  <div id="wrapper">
    <h1>呼び出しています</h1>
    <div class="detail">
      <p class="loading"><i class="fa fa-spinner fa-spin"></i></p>
      <p>お掛けになってお待ちください</p>
      <div class="footer-btn-list">
        <button onClick="location.href='index.php'" class="back">TOPへ戻る</button>
      </div>
    </div>
  </div>
</body>
</html>
