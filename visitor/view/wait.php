<?php
  include("../../dbconnection/config.php");

  $title = "呼び出し中";
  include_once "../component/meta.php";
?>
<body id="wait">
  <div id="wrapper">
    <h1>呼び出しています</h1>
    <div class="detail">
      <p class="loading"><i class="fa fa-spinner fa-spin"></i></p>
      <p>お掛けになってお待ちください</p>
      <div class="footer-btn-list">
        <button onClick="location.href='index.php'" class="back">TOPへ戻る</button>
      </div>
    </div>
    <div id="loader" class="loader">
      <div class="loader-animation"></div>
    </div>
  </div>
</body>
</html>
