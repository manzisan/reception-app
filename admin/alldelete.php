<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $id = $_POST["id"];

  $stmt = $pdo->prepare('select * from schedule where id = :id');
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);

  //実行
  $stmt -> execute();
  while($sql = $stmt->fetch(PDO::FETCH_ASSOC)){
    $date = $sql["date"];
    $hours = $sql["hours"];
    $minutes = $sql["minutes"];
    $company = $sql["company"];
    $customer = $sql["customer"];
    $employee = $sql["employee"];
  }

  $title = "削除確認";
  include_once "layout/meta.php";
?>
<body>
  <main>
    <h1>来訪予定削除確認</h1>
    <form action="index.php">
      <p class="comp_p"><?php echo "0"; ?>件のデータが選択されています</p>
      <p class="comp_p">削除してもよろしいですか？</p>
      <button type="submit" class="submit btn btn-danger" method="post">削除</button>
      <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">戻る</button>
    </form>
  </main>
</body>
</html>
