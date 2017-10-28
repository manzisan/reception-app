<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $sql = $pdo->prepare('SELECT name,id FROM employee');
  $sql -> execute();

  $employee_list = [];
  while($row = $sql->fetch(PDO::FETCH_ASSOC)){
    array_push($employee_list, $row);
  }

  $count = $sql -> rowCount();

  $title = "予定登録";
  include_once "layout/meta.php";
?>

<body>
  <main id="add">
    <h1>来訪予定登録</h1>
    <form method ="post" action="conf.php" name="form1">
      <div class="input-row">
        <div class="input-label">日時</div>
        <input type="text" class="date form-control" name="date" id="datepicker" readonly>
        <input type="text" class="time form-control" maxlength="2" name="hours">  <span class="time-span">:</span>
        <input type="text" class="time form-control" maxlength="2" name="minutes">
      </div>

      <div class="input-row">
        <div class="input-label">来訪社名</div>
        <input type="text" name="company" class="form-control">
      </div>

      <div class="input-row">
        <div class="input-label">来訪者氏名</div>
        <input type="text" name="customer" class="form-control">
      </div>

      <div class="input-row employee">
        <div class="input-label">担当者名</div>
        <select name="employee" class="form-control">
          <option v-for="employee in employees | filterBy search in 'name'" value="{{ employee.id }}">
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