<?php 
  $title = "入力";
  include_once "../component/meta.php";
?>
<body>
  <div id="wrapper">
    <h1>お客様の会社名とお名前を入力してください</h1>
    <form action="list.php" method="post" id="form">
      <p>会社名</p>
      <input type="text" name="company" class="input">
      <p>お名前</p>
      <input type="text" name="name" class="input">
    </form>
    <div class="footer-btn-list">
      <button onClick="location.href='index.php'" class="back">戻る</button>
      <button onclick="$('#form').submit();" class="next">次へ</button>
    </div>
    <div id="loader" class="loader">
      <div class="loader-animation"></div>
    </div>
  </div>
</body>
</html>
