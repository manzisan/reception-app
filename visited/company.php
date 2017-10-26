<?php 
  $title = "入力";
  include_once "layout/meta.php";
?>
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
