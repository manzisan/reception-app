<?php
  include("../../dbconnection/config.php");
  

  $stmt = $pdo->prepare('select * from schedule order by hours asc, minutes asc;');

  $stmt -> execute();

  $title = "一覧";
  include_once "../component/meta.php";

  $schedule_list = [];
  $emp_name = [];
  $i = 0;
  foreach ($stmt as $row) {
    array_push($schedule_list,$row);
    $employee_id = $row["employee"];
    $sql = $pdo -> prepare('SELECT name from employee where id ='.$employee_id);
    $sql -> execute();
    while($emp = $sql -> fetch(PDO::FETCH_ASSOC)) {
      $schedule_list[$i]["employee"] = $emp["name"];
      $i++;
    }
  }
?>
<body>
  <div id="wrapper">
    <header>
      <h1>アポイントメント一覧</h1>
    </header>
    <div id="refine">
      <div class="input">
        <input type="text" class="search-date form-control" id="datepicker" placeholder="日付" readonly>
        <!-- <input type="text" class="form-control" placeholder="担当者名" id="emp-name"> -->
      </div>
      <div class="ctrl-btn">
        <button type="button" class="btn btn-success" onClick="location.href='add.php'"><i class="fa fa-plus" aria-hidden="true"></i> 予定登録</button>
        <button type="button" class="btn btn-primary" onClick="location.href='add.php'"><i class="fa fa-plus" aria-hidden="true"></i> 社員管理</button>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
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
          <td class="id">{{ schedule.id }}</td>
          <td>{{ schedule.date }} {{ schedule.hours }}:{{ schedule.minutes }}</td>
          <td>{{ schedule.company }}</td>
          <td>{{ schedule.customer }}</td>
          <td>{{ schedule.employee }}</td>
          <td><input type="text" v-bind:value="schedule.code" readonly class=""></td>
          <td>
            <form id="form" name="form" action="change.php" method="post">
              <input type="hidden" name="id" v-bind:value="schedule.id">
              <button type="submit" class="btn change"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </form>
            <form id="form" name="form" action="delete.php" method="post">
              <input type="hidden" name="id" v-bind:value="schedule.id">
              <button type="submit" class="btn delete"><i class="fa fa-times" aria-hidden="true"></i></button>
            </form>
          </td>
        </tr> 
      </tbody>
    </table>
  </div>
</body>
<script type="text/javascript">
  const schedule = <?php echo json_encode($schedule_list);?>;
  const schedule_list = {
    schedule_lists: schedule,
    search: ""
  };
  const myViewModel = new Vue({
    el: '.schedule-list',
    data: schedule_list
  });
  $('#datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
  });
  $('.search-date').on('change',()=> {
    const filtered_schedules = schedule.filter((sche)=> {
      if (sche.date == $('#datepicker').val()) {
        return sche.date;
      }
    });
    myViewModel.schedule_lists = filtered_schedules;
  });
  $('.check-list').click(()=> {
    if ($(this).prop('checked') == false) {
      $('.alldelete').attr('disabled', 'disabled');
    } else {
      $('.alldelete').removeAttr('disabled');
    }
  });
</script>
</html>