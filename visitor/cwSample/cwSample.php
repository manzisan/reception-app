<!doctype html>
<html lang = "ja">
  <head>
    <meta charset = "UTF-8">
    <!-- <link rel = "stylesheet" type = "text/css" href = ""> CSSファイルは後で指定する  -->
    <title>ChatworkSample</title>
  </head>
  <body>
    <form action = "cwSend.php" method = "post">
      <input type = "text" name = "api" placeholder = "APIKey">
      <input type = "text" name = "roomid" placeholder = "RoomID">
      <input type = "text" name = "message" placeholder =  "Message">
      <input type = "submit" value = "Chatworkに送信">
    </form>
  </body>
</html>
