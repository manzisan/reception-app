<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  $stmt = $pdo->prepare('select * from schedule order by hours asc, minutes asc;');

  $stmt -> execute();

  $title = "トップ";
  include_once "layout/meta.php";

  $schedule_list = [];

  foreach ($stmt as $row) {
    array_push($schedule_list, $row);
    $employee = $row["employee"];

    $sql = $pdo -> prepare('SELECT name from employee where id = '.$employee);
    $sql -> execute();
    while($emp = $sql -> fetch(PDO::FETCH_ASSOC)){
      $name = $emp["name"];
    }
    $employee = $name;
    
  }
?>
<body>
  <div id="wrapper">
    <header>
      <h1>来訪予定</h1>
    </header>
    <div id="refine">
      <p>絞り込み</p>
      <div id="dropdown">
        <input type="text" class="search-date form-control" id="datepicker" placeholder="日付" readonly value="">
      </div>
      <input type="text" class="form-control" placeholder="担当者名" id="emp-name">
      <div class="ctr_btn">
        <button type="button" class="btn btn-success" onClick="location.href='add.php'">予定登録</button>
        <button type="button" class="btn btn-danger" onClick="location.href='alldelete.php'">一括削除</button>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>選択</th>
          <th>ID</th>
          <th>日付</th>
          <th>会社名</th>
          <th>来訪者名</th>
          <th>担当者名</th>
          <th>招待コード</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="schedule-list">
        <tr v-for="schedule in schedule_lists">
          <td><input type="checkbox" value="{{ schedule.id }}"></td>
          <td>{{ schedule.id }}</td>
          <td>{{ schedule.date }} {{ schedule.hours }}:{{ schedule.minutes }}</td>
          <td>{{ schedule.company }}</td>
          <td>{{ schedule.customer }}</td>
          <td>{{ schedule.employee }}</td>
          <td><input type="text" value="{{ schedule.code }}" readonly></td>
          <td>
            <form id="form" name="form" action="change.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-primary change">変更</button>
            </form>
            <form id="form" name="form" action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-danger delete">削除</button>
            </form>
          </td>
        </tr> 
      </tbody>
    </table>
  </div>
</body>
<script type="text/javascript">
  $(function () {
    var schedule = <?php echo json_encode($schedule_list);?>;
    var schedule_list = {
      schedule_lists: schedule,
      emp_name: "<?php echo $employee; ?>",
      search: ""
    };
    var myViewModel = new Vue({
      el: '.schedule-list',
      data: schedule_list
    });

    var dateFormat = 'yy-mm-dd';
    $('#datepicker').datepicker({
      dateFormat: dateFormat
    });

    var emplist = document.getElementById('emp-name');
    emplist.addEventListener('input',()=> {
      console.log(this.value);
      console.log($('#datepicker').val());
    });

    $('.search-date').on('change',()=>{
      schedule_list.search = $('#datepicker').val();
      console.log(schedule_list.search);
    });

  });
</script>
</html>
