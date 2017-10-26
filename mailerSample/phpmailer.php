<?php
$company = "あいうえお";
$visitor = "かきくけこ";
require_once('PHPMailerAutoload.php');  //PHPMailer の読み込み
$mail = new PHPMailer;  //PHPMailer のインスタンスを生成

$mail->isSMTP();    // SMTP を使用
$mail->Host = 'smtp.gmail.com';  // SMTP サーバーを指定
$mail->SMTPAuth = true;         // SMTP authentication を有効に
$mail->Username = 'tdmx.macrophage@gmail.com';   // SMTP ユーザ名
$mail->Password = 'Nintendo0399';   // SMTP パスワード
$mail->SMTPSecure = 'tls';   // TLS encryption を有効に
$mail->Port = 587;    // TCP ポートを指定

$mail->setFrom('tdmx.macrophage@gmail.com', 'Mailer');    //差出人
$mail->addAddress('tdmx.macrophage@gmail.com', 'WDL');     // 受信アドレス
// $mail->addReplyTo('xxxxxxxx@gmail.com', 'Information');    //返信用アドレス
// $mail->addCC('test@example.com');    //Cc アドレス

//$mail->addAttachment('photo_01.jpg');  // 添付ファイルを追加
$mail->isHTML(true);   // HTML形式のメールに設定

$mail->Subject = 'Here is the subject';
$mail->Body    = $company .'&nbsp;'. $visitor.'がお見えになられてます。';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();
// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent';
// }
