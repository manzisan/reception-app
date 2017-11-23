<?php 
  $title = "入力";
  include_once "../component/meta.php";
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
          <button>事務</button>
          <button>経理</button>
          <button>人事</button>
          <button>その他</button>
        </div>
        <div>
        <a href="waitdeli.php">配達業者様</a>
        <a href="waitother.php">その他のお客様</a>
      </div>
    </form>
    <div class="footer-btn-list">
      <a href="recepcode.php" class="back">戻る</button>
      <a onclick="$('#form').submit();" class="next">次へ</button>
    </div>
    <div id="loader" class="loader">
      <div class="loader-animation"></div>
    </div>
  </div>
</body>
</html>