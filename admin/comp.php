<?php
  include("../dbconnection/config.php");
  include("../dbconnection/connect.php");

  //SQL文
  $stmt = $pdo->prepare('select code from schedule');

  //SQL実行
  $stmt -> execute();

  //空の配列を用意する
  $num = array();

  //データベースに入っている生成済みの乱数を配列に入れる
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $num[] = $row["code"];
  }

  //0-9999までループ
  for($i=0; $i < 9999; $i++){
    // 1度実行して、whileが真の間繰り返し
    // while条件は「生成済みの値がすでにセットされているか」
    do{
      $rnd = mt_rand(0,9999);
    }while(isset($num[$rnd]));
  }

  $rnd = sprintf("%04d",$rnd);
  $num[] = $rnd;


  // $stmt = $pdo -> prepare("insert into schedule (date, hours, minutes, company, customer, representative, code)
  //                         values (:date, :hours, :minutes, :company, :customer, :representative, :code");

  $stmt = $pdo -> prepare("insert into schedule (id,date,hours,minutes,company,customer,employee,code) values (null,:date,:hours,:minutes,:company,:customer,:employee,:code)");


  $stmt -> bindValue(':date', $_POST["date"], PDO::PARAM_STR);
  $stmt -> bindValue(':hours', $_POST["hours"], PDO::PARAM_INT);
  $stmt -> bindValue(':minutes', $_POST["minutes"], PDO::PARAM_INT);
  $stmt -> bindParam(':company', $_POST["company"], PDO::PARAM_STR);
  $stmt -> bindParam(':customer', $_POST["customer"], PDO::PARAM_STR);
  $stmt -> bindParam(':employee', $_POST["employee"], PDO::PARAM_INT);
  $stmt -> bindParam(':code', $rnd, PDO::PARAM_STR);
  $stmt -> execute();

  $title = "登録完了";
  include_once "layout/meta.php";
?>
<body>
  <main>
    <h1>来訪予定登録完了</h1>
    <div class="comp_finish">
      <p>登録完了しました。</p>
      <p>招待コードは
        <span>
          <input type="text" readonly value="<?php echo $rnd; ?>">
        </span>です
      </p>
      <button type="button" class="back btn btn-primary" onClick="location.href='index.php'">TOPへ戻る</button>
    </div>
  </main>
</body>
</html>
