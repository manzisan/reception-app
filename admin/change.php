<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $id = $_POST["id"];

  $stmt = $pdo -> prepare('select * from schedule where id = "'. $id.'"');

  //実行
  $stmt -> execute();
  while($sql = $stmt->fetch(PDO::FETCH_ASSOC)){
     $date = $sql["date"];
     $hours = $sql["hours"];
     $minutes = $sql["minutes"];
     $company = $sql["company"];
     $customer = $sql["customer"];
     $employee = $sql["employee"];
     $code = $sql["code"];
  }

  $sql = $pdo->prepare('SELECT name,nickname FROM employee');
  $sql -> execute();

  while($row = $sql->fetch(PDO::FETCH_ASSOC)){
    $nickname[] = $row["nickname"];
    $name[] = $row["name"];
  }

  $count = $sql -> rowCount();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
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
        echo "{ name: \"$name[$i]($nickname[$i])\",},";
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
<title>来訪予定変更</title>
</head>
<body>
<script type="text/javascript">
function check(){

  var flag = 0;

  // 設定
  if(document.form1.date.value == ""){
    flag = 1;
  }
  else if(document.form1.hours.value == ""){
    flag = 1;
  }
  else if(document.form1.minutes.value == ""){
    flag = 1;
  }
  else if(document.form1.company.value == ""){
    flag = 1;
  }
  else if(document.form1.customer.value == ""){
    flag = 1;
  }
  // 設定終了

  if(flag){
    window.alert('未入力の項目があります！'); // 入力漏れがあれば警告ダイアログを表示
    return false; // 送信を中止
  }
  else{
    return true; // 送信を実行
  }

}
</script>
<main>
<h1>来訪予定変更</h1>
<form method ="post" action="cng_run.php" name="form1" onSubmit="return check()">
  <div class="form_time">
    <h2>来訪日時:</h2>
      <div>
        <input type="text" class="date form-control" name="date" id="datepicker" value="<?php echo $date ?>" readonly>
        <input type="number" class="time form-control" min="0" max="23" name="hours" value="<?php echo $hours ?>">
          <span>:</span>
        <input type="number" class="time form-control" min="0" max="59" name="minutes" value="<?php echo $minutes ?>">
          <span>〜</span>
      </div>
  </div><!-- time -->

  <div class="form_company">
    <h2>来訪社名:</h2>
    <input type="text" name="company" class="form-control" value="<?php echo $company ?>">
  </div>

  <div class="form_customer">
    <h2>来訪者名:</h2>
    <div>様</div><input type="text" name="customer" class="form-control" value="<?php echo $customer ?>">
  </div>



  <div class="form_employee">
    <h2>担当者名:</h2>
      <select name="employee" class="form-control">
      <option v-for="friend in friends | filterBy search in 'name'" value="">{{ friend.name }}
            </option>
    </select>
  </div>

  <input type="hidden" name = "code" value="<?php echo $code ?>" >
  <button type="submit" class="submit btn btn-success" method="post">変更</button>
  <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">戻る</button>
  </form>
</main>
<script>
  window.onload=function(){
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
    // tbody[i].style.display="none";
  }
}
  </script>
</body>
</html>
