<?php
  include("../../dbconnection/config.php");
  

  $id = $_POST["id"];

  $stmt = $pdo->prepare('select * from schedule where id = :id');
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);

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
  include_once "../component/meta.php";
?>
<body>
  <main>
    <h1>来訪予定登録削除確認</h1>
    <form method ="post" action="del_run.php" name="form1">
      <section>
        <h2>来訪日時:</h2>
        <p class="comp_content"><?php echo $date ?>&nbsp;<?php echo $hours ?>:<?php echo $minutes ?></p>
      </section>

      <section>
        <h2>来訪社名:</h2>
        <p class="comp_content"><?php echo $company ?></p>
      </section>

      <section>
        <h2>来訪者名:</h2>
        <p class="comp_content"><?php echo $customer ?></p>
      </section>

      <section>
        <h2>担当者名:</h2>
        <p class="comp_content"><?php echo $employee ?></p>
      </section>

      <p class="comp_p">以上の予定を削除します。</p>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">戻る</button>
      <button type="submit" class="submit btn btn-danger" method="post">削除</button>
    </form>
  </main>
</body>
</html>
