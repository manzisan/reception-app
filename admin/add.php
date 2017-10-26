<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $sql = $pdo->prepare('SELECT name FROM employee');

  $sql -> execute();

  while($row = $sql->fetch(PDO::FETCH_ASSOC)){
    $name[] = $row["name"];
  }

  $count = $sql -> rowCount();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/add.css">
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script>
$(function () {
  var dateFormat = 'yy-mm-dd';
  $('#datepicker').datepicker({
      dateFormat: dateFormat
  });

  var myModel = {
    friends: [
    <?php for ($i=0; $i < $count; $i++) {
        echo "{ name: \"$name[$i]\",},";
       }
      ?>
    ],
    search: ""

  };

  var myViewModel = new Vue({
    el: '.form_employee',
    data: myModel
  });
});
</script>
<title>来訪予定登録</title>
</head>
<body>
<script type="text/javascript">
function check(){

  var flag = 0;

  // 設定
  if(document.form1.date.value == ""){ // 「お名前」の入力をチェック
    flag = 1;
  }
  else if(document.form1.hours.value == ""){ // 「パスワード」の入力をチェック
    flag = 1;
  }
  else if(document.form1.minutes.value == ""){ // 「コメント」の入力をチェック
    flag = 1;
  }
  else if(document.form1.company.value == ""){ // 「コメント」の入力をチェック
    flag = 1;
  }
  else if(document.form1.employee.value == ""){ // 「コメント」の入力をチェック
    flag = 1;
  }
  // 設定終了

  if(flag) {
    alert('未入力の項目があります！'); // 入力漏れがあれば警告ダイアログを表示
    return false; // 送信を中止
  }
  else {
    return true; // 送信を実行
  }

}
</script>
  <main>
    <h1>アポイント登録</h1>
    <form method ="post" action="conf.php" name="form1" onSubmit="return check()">

      <div class="form_time">
        <div class="label">日時</div>
        <div>
          <input type="text" class="form-control" name="date" id="datepicker" readonly>
          <input type="number" class="time form-control" min="0" max="23" name="hours"><span>:</span>
          <input type="number" class="time form-control" min="0" max="59" name="minutes"><span>〜</span>
        </div>
      </div>

      <div class="form_company">
        <div class="label">来訪社名</div>
        <input type="text" name="company" class="form-control">
      </div>

      <div class="form_customer">
        <div class="label">来訪者氏名</div>
        <input type="text" name="customer" class="form-control">様
      </div>

      <div class="form_employee">
        <div class="label">担当者名</div>
        <select name="employee" class="form-control">
          <option v-for="friend in friends | filterBy search in 'name'" value="">
            {{ friend.name }}
          </option>
        </select>
      </div>

      <div class="btn-row">
        <button type="submit" class="submit btn btn-success">登録</button>
        <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">戻る</button>
      </div>

    </form>
  </main>
</body>
<script>

  <?php
    $stmt = $pdo->prepare('select id from schedule');
    $stmt->execute();
    $ids = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $ids[] = $row['id'];
    }
  ?>

  var ids = <?= json_encode($ids); ?>;
  var option = document.getElementsByTagName('option');

  for (var i = 0; i < option.length; i++) {
    var id = i;
    option[i].value=id+1;
    id++;
  }

</script>
</html>