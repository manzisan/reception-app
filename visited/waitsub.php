<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $company = $_POST["company"];
  $customer = $_POST["visitor"];

  //chatwork start
      //chatworkのルームID *rid以下* を指定する
      $roomId = "58637150"; //testルームIDが入ってる
      //APIKeyを指定する
      $api = "be450f970e02851abc3329c64e11011c";
      //投稿内容を入れる
      $body = '[info][title]来客通知[/title]'.$company.' '. $customer.'様がお見えになられてます。[/info]';

      $option = array('body' => $body);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.chatwork.com/v1/rooms/' . $roomId . '/messages');
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-ChatWorkToken: ' . $api));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($option, '', '&'));

      //サーバー証明書の検証はしない
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      //投稿
      curl_exec($ch);
      curl_close($ch);
  //chatwork end

  //mailer start
      require_once('../PHPMailer/PHPMailerAutoload.php');  //PHPMailer の読み込み
      $mail = new PHPMailer;  //PHPMailer のインスタンスを生成

      $mail->isSMTP();    // SMTP を使用
      $mail->Host = 'smtp.gmail.com';  // SMTP サーバーを指定
      $mail->SMTPAuth = true;         // SMTP authentication を有効に
      $mail->Username = 'tdmx.macrophage@gmail.com';   // SMTP ユーザ名
      $mail->Password = 'Nintendo0399';   // SMTP パスワード
      $mail->SMTPSecure = 'tls';   // TLS encryption を有効に
      $mail->Port = 587;    // TCP ポートを指定
      $mail->setFrom('tdmx.macrophage@gmail.com', 'LIG来訪者通知システム');    //差出人
      $mail->addAddress('manzisann@gmail.com', 'WDL');     // 受信アドレス
      $mail->isHTML(true);   // HTML形式のメールに設定

      $mail->Subject = mb_encode_mimeheader('来訪通知');
      $mail->CharSet = 'UTF-8';
      $mail->Body    = $company.'&nbsp;'.$customer.'様がお見えになられてます。';
      $mail->send();
//mailer end

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
<link rel="stylesheet" type="text/css" href="css/wait.css">
<link rel="stylesheet" type="text/css" href="css/button.css">
<title>受付</title>
<script>
  $(window).on('touchmove.noScroll', function(e) {
    e.preventDefault();
  });
  window.onload=function(){
    var back = document.getElementById('back');

    function returntop(){
      location.href="index.php";
    }

    setTimeout(returntop,5000);
  }
</script>
</head>
<body>
<div id="wrapper">

  <h1>呼び出しています</h1>

    <p>お掛けになってお待ちください</p>
  </div class="a_list">
    <a href="index.php" class="back">TOPへ戻る</a>
  </div>
</body>
</html>
