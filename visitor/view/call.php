<?php
  $title = "呼び出し";
  include("../../dbconnection/config.php");
  include_once "../component/meta.php";
?>
<body>
  <div id="wrapper">
    <h1><?php echo $company ?><br><?php echo $customer ?> 様<br>ようこそお越しくださいました。</h1>
    <div class="member">
      <img src="../src/img/member/<?php echo $id != 0 ? $id : 0 ?>.jpg">
      <p><?php echo $div ?></p>
      <p><?php echo $kana ?></p>
      <p><?php echo $name;?></p>
    </div>
    <p class="calltext">以上の内容でよろしければ、<br>「呼び出す」ボタンを押してください。</p>
    <form action="wait.php" method="post" id="form">
      <input type="hidden" name="code" value="<?php echo $code ?>">
    </form>
    <div class="footer-btn-list">
      <a href="recep-code.php" class="back">戻る</button>
      <a onclick="$('#form').submit();" class="next">呼び出す</button>
    </div>
    <div id="loader" class="loader">
      <div class="loader-animation"></div>
    </div>
  </div>
</body>
</html>
