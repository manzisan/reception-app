<?php 
  $title = "入力";
  include_once "../layout/meta.php";
?>
<body>
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
      <div>
      <a href="waitdeli.php">配達業者様</a>
      <a href="waitother.php">その他のお客様</a>
    </div>
  </form>
  <a href="index.php" class="back">戻る</a>
</div>
</body>
</html>
