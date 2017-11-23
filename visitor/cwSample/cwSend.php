<?php
  //APIKeyを受け取る
  $key = $_POST["api"];
  //RoomIDを受け取る
  $id = $_POST["roomid"];
  //Messageを受け取る
  $msg = $_POST["message"];

  // // 投稿するルームID（チャットURL中のrid～の8桁の数値部分）
  $roomId = $id;
  // // 管理者画面から提供された専用のトークン。
  $chatworkToken = $key;
  // 投稿内容
  $body = '[info][title]来客通知[/title]'.$msg.'[/info]';

  $option = array('body' => $body);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.chatwork.com/v1/rooms/' . $roomId . '/messages');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-ChatWorkToken: ' . $chatworkToken));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($option, '', '&'));

  //SSLでの通信のため証明書の指定が必要
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  // 投稿。ちゃんと制御する場合は戻り値を確認する
  $responce = curl_exec($ch);
  echo $responce;
  curl_close($ch);


// //chatwork start
//   //chatworkのルームID *rid以下* を指定する
//   $roomId = "58637150"; //testルームIDが入ってる
//   //APIKeyを指定する
//   $api = "be450f970e02851abc3329c64e11011c";
//       //投稿内容を入れる
//       $body = '[info][title]来客通知[/title]来訪者がお見えになられてます。[/info]';

//       $option = array('body' => $body);
//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_URL, 'https://api.chatwork.com/v1/rooms/' . $roomId . '/messages');
//       curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-ChatWorkToken: ' . $api));
//       curl_setopt($ch, CURLOPT_POST, 1);
//       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($option, '', '&'));

//       //サーバー証明書の検証はしない
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       //投稿
//       curl_exec($ch);
//       curl_close($ch);
//   //chatwork end