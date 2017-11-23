<?php
  include("../../dbconnection/config.php");
  

  $date = $_POST["date"];
  $hours = sprintf("%02d",$_POST["hours"]);
  $minutes = sprintf("%02d",$_POST["minutes"]);
  $company = $_POST["company"];
  $customer = $_POST["customer"];
  $employee = $_POST["employee"];

  $sql = $pdo -> prepare('SELECT name from employee where id = "'.$employee.'"');
  $sql -> execute();
  while($emp = $sql -> fetch(PDO::FETCH_ASSOC)){
    $name = $emp["name"];
  }

  $disp_employee = $name;

  $title = "登録完了";
  include_once "../component/meta.php";
?>
<body>
  <main>
    <h1>来訪予定登録完了</h1>
    <form action="comp.php" method="post">
      <section>
        <h2>来訪日時:</h2>
        <p class="comp_content"><?php echo $date ?>&nbsp;<?php echo $hours ?>:<?php echo $minutes ?></p>
        <input type="hidden" name="date" value="<?php echo $date ?>">
        <input type="hidden" name="hours" value="<?php echo $hours ?>">
        <input type="hidden" name="minutes" value="<?php echo $minutes ?>">
      </section>

      <section>
        <h2>来訪社名:</h2>
        <p class="comp_content"><?php echo $company ?></p>
        <input type="hidden" name="company" value="<?php echo $company ?>">
      </section>

      <section>
        <h2>来訪者名:</h2>
        <p class="comp_content"><?php echo $customer?></p>
        <input type="hidden" name="customer" value="<?php echo $customer ?>">
      </section>

      <section>
        <h2>担当者名:</h2>
        <p class="comp_content"><?php echo $disp_employee ?></p>
        <input type="hidden" name="employee" value="<?php echo $employee ?>">
      </section>

      <p class="comp_p">でよろしいですか？</p>
      <button type="button" class="back btn btn-primary" onClick="location.href='add.php'">戻る</button>
      <button type="submit" class="submit btn btn-success" method="post">登録</button>
    </form>
  </main>
</body>
</html>
