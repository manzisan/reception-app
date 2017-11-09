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

  $sql2 = $pdo -> prepare('SELECT cid,nickname from employee where id in (select employee from schedule where code = "'.$code.'") ');
  $sql2 -> execute();
  while($cto= $sql2 -> fetch(PDO::FETCH_ASSOC)){
    $nickname = $cto["nickname"];
    $cid = $cto["cid"];
  }
  //chatwork start
      //chatworkのルームID *rid以下* を指定する
      $roomId = "58637150"; //testルームIDが入ってる
      //APIKeyを指定する
      $api = "be450f970e02851abc3329c64e11011c";
      //投稿内容を入れる
      $body = '[info][title]来客通知[/title][To:'.$cid.']'.$nickname.'さん '.$company.' '. $customer.'様がお見えになられてます。[/info]';

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
      $mail->Username = 'xxx@gmail.com';   // SMTP ユーザ名
      $mail->Password = 'xxxxxx';   // SMTP パスワード
      $mail->SMTPSecure = 'tls';   // TLS encryption を有効に
      $mail->Port = 587;    // TCP ポートを指定
      $mail->setFrom('xxx@gmail.com', 'LIG来訪者通知システム');    //差出人
      $mail->addAddress('xxx@ooo.com', '');     // 受信アドレス
      $mail->isHTML(true);   // HTML形式のメールに設定

      $mail->Subject = mb_encode_mimeheader('来訪通知');
      $mail->CharSet = 'UTF-8';
      $mail->Body    = $company.'&nbsp;'.$customer.'様がお見えになられてます。';
      $mail->send();
//mailer end

    //通知した予定を削除する
    $sql = $pdo -> prepare('delete from schedule where code = "'.$code.'"');
    $sql -> execute();

    $title = "呼び出し中";
    include_once "../layout/meta.php";
?>
<body>
<div id="wrapper">

  <h1>呼び出しています</h1>

    <p>お掛けになってお待ちください</p>
  </div class="a_list">
    <a href="index.php" class="back">TOPへ戻る</a>
  </div>
</body>
</html>
