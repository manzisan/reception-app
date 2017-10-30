<?php
  include("../../dbconnection/config.php");
  include("../../dbconnection/connect.php");

  $id = $_POST["id"];

  $stmt = $pdo -> prepare('select * from schedule where id = "'. $id.'"');

  $stmt -> execute();
  while($sql = $stmt->fetch(PDO::FETCH_ASSOC)){
    $date = $sql["date"];
    $hours = $sql["hours"];
    $minutes = $sql["minutes"];
    $company = $sql["company"];
    $customer = $sql["customer"];
    $code = $sql["code"];
  }

  $sql = $pdo->prepare('SELECT name,id FROM employee');
  $sql -> execute();

  $employee_list = [];
  while($row = $sql->fetch(PDO::FETCH_ASSOC)){
    array_push($employee_list, $row);
  }

  $count = $sql -> rowCount();

  $title = "予定変更";
  include_once "layout/meta.php";
?>
<body id="change">
  <main>
    <h1>来訪予定変更</h1>
    <form method ="post" action="cng_run.php" name="form1">
      <div class="input-row">
        <div class="input-label">日時</div>
        <input type="text" class="date form-control" name="date" id="datepicker" readonly value="<?php echo $date ?>">
        <input type="text" class="time form-control" maxlength="2" name="hours" value="<?php echo $hours ?>">  <span class="time-span">:</span>
        <input type="text" class="time form-control" maxlength="2" name="minutes" value="<?php echo $minutes ?>">
      </div>

      <div class="input-row">
        <div class="input-label">来訪社名</div>
        <input type="text" name="company" class="form-control" value="<?php echo $company ?>">
      </div>

      <div class="input-row">
        <div class="input-label">来訪者氏名</div>
        <input type="text" name="customer" class="form-control" value="<?php echo $customer ?>">
      </div>

      <div class="input-row employee">
        <div class="input-label">担当者名</div>
        <select name="employee" class="form-control">
          <option v-for="employee in employees"  v-bind:value="employee.id">
            {{ employee.name }}
          </option>
        </select>
      </div>

      <div class="btn-row">
        <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">戻る</button>
        <button type="submit" class="submit btn btn-success">登録</button>
      </div>
    </form>
  </main>
</body>
<script>
  var employee_list = <?= json_encode($employee_list); ?>;

  var myModel = {
    employees: employee_list,
    search: ""
  };

  var myViewModel = new Vue({
    el: '.employee',
    data: myModel
  });
</script>
</html>
