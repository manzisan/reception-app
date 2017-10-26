<?php
include("../dbconnection/config.php");
include("../dbconnection/connect.php");

//今日の日付を取得する

$stmt = $pdo->prepare('select * from schedule order by hours asc, minutes asc;');


//実行
$stmt -> execute();

?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.0.js" integrity="sha256-wPFJNIFlVY49B+CuAIrDr932XSb6Jk3J1M22M3E2ylQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(function () {
        var dateFormat = 'yy-mm-dd';
        $('#datepicker').datepicker({
          dateFormat: dateFormat
        });
      });
    </script>
    <title>来客受付システム</title>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <h1>来訪予定</h1>
      </header>
      <div id="refine">
        <p>絞り込み</p>
        <div id="dropdown">
          <input type="text" class="form-control" id="datepicker" placeholder="日付" readonly>
        </div>
      <input type="text" class="form-control" placeholder="担当者名">
      <div class="ctr_btn">
        <button type="button" class="btn btn-success" onClick="location.href='add.php'">予定登録</button>
        <button type="button" class="btn btn-danger" onClick="location.href='alldelete.php'">一括削除</button>
      </div>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>選択</th>
            <th>日付</th>
            <th>会社名</th>
            <th>来訪者名</th>
            <th>担当者名</th>
            <th>招待コード</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach ($stmt as $row):
          $date = $row["date"];
          $hours = $row["hours"];
          $minutes = $row["minutes"];
          $company = $row["company"];
          $customer = $row["customer"];
          $employee = $row["employee"];

          $sql = $pdo -> prepare('SELECT name from employee where id = '.$employee);
          $sql -> execute();
          while($emp = $sql -> fetch(PDO::FETCH_ASSOC)){
            $name=$emp["name"];
          }
          $employee = $name;
          $code = $row["code"];
          $id = $row["id"];
        ?>
        <tr>
          <td><input type="checkbox" value="<?php echo $code ?>"></td>
          <td><?php echo $date; ?> &nbsp; <?php echo $hours; ?>:<?php echo $minutes; ?></td>
          <td><?php echo $company; ?></td>
          <td><?php echo $customer; ?></td>
          <td><?php echo $employee; ?></td>
          <td><input type="text" readonly value="<?php echo $code; ?>"></td>
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
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
