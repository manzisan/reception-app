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

  $title = "予定変更";
  include_once "layout/meta.php";
?>
<body>
<main>
<h1>来訪予定変更</h1>
<form method ="post" action="cng_run.php" name="form1">
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
