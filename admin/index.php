<?php
include("../dbconnection/config.php");
include("../dbconnection/connect.php");

//今日の日付を取得する
$nowdate = date('Y-m-d');

$stmt = $pdo->prepare('select * from schedule where date = "'.$nowdate.'" order by hours asc, minutes asc;');

//実行
$stmt -> execute();

 ?>

<!doctype html>
<html lang = "ja">
  <head>
    <meta charset = "UTF-8">
    <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    <script src = "js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    <script type="text/javascript">
      $(function () {
        //datepicker
        var dateFormat = 'yy-mm-dd';
        $('#datepicker').datepicker({
            dateFormat: dateFormat
          });
        //end
      });

      function set2fig(num) {
       // 桁数が1桁だったら先頭に0を加えて2桁に調整する
       var ret;
       if( num < 10 ) { ret = "0" + num; }
       else { ret = num; }
       return ret;
      }
      function showClock2() {
       var nowTime = new Date();
       var nowYear = set2fig( nowTime.getFullYear() );
       var nowMonth = set2fig( nowTime.getMonth() +1);
       var nowDate = set2fig( nowTime.getDate() );
       var nowHour = set2fig( nowTime.getHours() );
       var nowMin = set2fig( nowTime.getMinutes() );
       var nowSec = set2fig( nowTime.getSeconds() );
       var msg = "現在時刻は、" + nowYear + "/" + nowMonth + "/" + nowDate + "&nbsp;" + nowHour + ":" + nowMin + ":" + nowSec + " です。";
       document.getElementById("RealtimeClockArea2").innerHTML = msg;
      }
      setInterval('showClock2()',1000);
    </script>
    <title>来客受付システム</title>
  </head>
  <body>
    <p id="RealtimeClockArea2"></p>
    <div id = "wrapper">
      <header>
        <h1>来訪予定</h1>
      </header>
      <div id = "refine">
        <p>絞り込み</p>
        <div id = "dropdown">
          <input type="text" class="form-control" id="datepicker" placeholder="日付" readonly>
        </div>
      <input type="text" class="form-control" placeholder="担当者名">
      <div class="ctr_btn">
        <button type="button" class="btn btn-success" onClick="location.href='add.php'">予定登録</button>
        <button type="button" class="btn btn-danger" onClick="location.href='alldelete.php'">一括削除</button>
      </div>
      </div>
      <table class = "table table-hover">
        <thead>
          <tr>
            <th></th>
            <th>日付</th>
            <th>会社名</th>
            <th>来訪者名</th>
            <th>担当者名</th>
            <th>招待コード</th>
            <th>操作</th>
          </tr>
        </thead>
        <?php
        foreach ($stmt as $row){
          $date = $row["date"];
          $hours = $row["hours"];
          $minutes = $row["minutes"];
          $company = $row["company"];
          $customer = $row["customer"];
          $employee = $row["employee"];

          $sql = $pdo -> prepare('SELECT name from employee where id = '.$employee);
          $sql -> execute();
          while($emp = $sql -> fetch(PDO::FETCH_ASSOC)){
            $name = $emp["name"];
          }

          $employee = $name;

          $code = $row["code"];
          $id = $row["id"];
        ?>
        <tbody>
          <tr>
            <td><input type = "checkbox" value = "<?php echo $code ?>"></td>
            <td><?php echo $date; ?> &nbsp; <?php echo $hours; ?>:<?php echo $minutes; ?></td>
            <td><?php echo $company; ?></td>
            <td><?php echo $customer; ?></td>
            <td><?php echo $employee; ?></td>
            <td><input type="text" readonly value="<?php echo $code; ?>"></td>
            <td>
              <form id="form" name="form" action="change.php" method="post">
                <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                <button type = "submit" class = "btn btn-primary change" >変更</button>
              </form>
              <form id="form" name="form" action="delete.php" method="post">
                <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                <button type = "submit" class = "btn btn-danger delete">削除</button>
              </form>
            </td>
          </tr>
        </tbody>
        <?php
        }
        ?>
      </table>
    </div>
  </body>
</html>
