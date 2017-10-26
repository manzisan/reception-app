<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="img/icon.jpg">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/company.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <title>受付</title>
</head>
<body>
<div id="wrapper">
  <h1>会社名とお名前を入力してください</h1>
  <form action="list.php" method="post" id="form">
    <p>会社名</p>
    <input type="text" name="company" class="input">
    <p>お名前</p>
    <input type="text" name="name" class="input">
    <input type="submit" class="next" value="次へ">
    <a href="recepcode.php" class="back">戻る</a>
  </form>
</div>
</body>
<script>
  $(window).on('touchmove.noScroll', function(e) {
    e.preventDefault();
  });
</script>
</html>
