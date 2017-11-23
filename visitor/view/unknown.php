<?php
  include("../../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $company = $_POST["company"];
  $customer = $_POST["name"];
  
  $title = "呼び出し中";
  include_once "../component/meta.php";
?>
<body>
<div id="wrapper">
  <h1>代わりの担当者を呼び出します</h1>

  <p>お掛けになってお待ちください</p>
  <a href="index.php" class="back">TOPへ戻る</a>
</body>
</html>
