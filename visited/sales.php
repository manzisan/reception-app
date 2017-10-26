<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="img/icon.jpg">
<link rel="stylesheet" type="text/css" href="css/sales.css">
<link rel="stylesheet" type="text/css" href="css/button.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>
<title>受付</title>
</head>
<body>

  <script>
    $(window).on('touchmove.noScroll', function(e) {
      e.preventDefault();
    });
  </script>

<div id="wrapper">
  <h1>会社名とお名前を入力してください</h1>
    <form action="waitsale.php" method="post" id="form">
      <p>会社名</p>
      <input type="text" name="company" class="input">
      <p>お名前</p>
      <input type="text" name="name" class="input">
      <p>どちらにご用ですか？</p>
      <div class="button_list">
        <button name = "require" value = "事務">事務</button>
        <button name = "require" value = "経理">経理</button>
        <button name = "require" value = "人事">人事</button>
        <button name = "require" value = "その他">その他</button>
      </div>
  </form>
  <a href="index.php" class="back">戻る</a>
</div>
</body>
</html>
