<?php
include("../dbconnection/config.php");
include("../dbconnection/connect.php");

$company = $_POST["company"];
$name = $_POST["name"];

$sql = $pdo->prepare('SELECT name,nickname,id,kana,division FROM employee order by kana asc');

$sql -> execute();
$friends = [];
while($row = $sql->fetch(PDO::FETCH_ASSOC)){
  array_push($friends, $row);
  $id = $row["id"];
}
$count = $sql -> rowCount();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="img/icon.jpg">
  <link rel="stylesheet" type="text/css" href="css/list.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<title>受付</title>
<script>
$(function(){


  var friends = <?php echo json_encode($friends);?>

  var namelist = {
    friends: friends,
    search: ""
  };

  var myViewModel = new Vue({
    el: '.employee_list',
    data: namelist
  });

  // var emplist = 

  var button = document.getElementsByTagName('button');

  var kanaList = {
    "あ": ["ア","イ","ウ","エ","オ"],
    "か": ["カ","キ","ク","ケ","コ"],
    "さ": ["サ","シ","ス","セ","ソ"],
    "た": ["タ","チ","ツ","テ","ト"],
    "な": ["ナ","ニ","ヌ","ネ","ノ"],
    "は": ["ハ","ヒ","フ","ヘ","ホ","バ","ビ","ブ","ベ","ボ","パ","ピ","プ","ペ","ポ"],
    "ま": ["マ","ミ","ム","メ","モ"],
    "や": ["ヤ","ユ","ヨ"],
    "ら": ["ラ","リ","ル","レ","ロ"],
    "わ": ["ワ","ヲ","ン"]
  };

  var inputValue = "";
  var input = document.getElementById('input');
  var li = document.getElementsByTagName('li');

for (var i = 0; i < li.length; i++) {
  li[i].addEventListener('click',function(e){
      e.preventDefault();
        myViewModel.search = this.innerHTML;
        var list = kanaList[this.innerHTML];
        // console.log(list);

        var filteredFriends = friends.filter(function(friend) {
          console.log(friend.kana,friend.kana.charAt(0),list.indexOf(friend.kana.charAt(0)) !== -1)
          return (list.indexOf(friend.kana.charAt(0)) !== -1);
        });
        myViewModel.friends = filteredFriends;
    });
  }
});
</script>
</head>
<body>
<div id="wrapper">
  <h1>担当者を選択してください</h1>
    <form action="unknown.php" method="post">
      <button class="forget">担当者がご不明な方</button>
       <input type="hidden" name="company" value="<?php echo $company; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
    </form>

    <form action="callsub.php" method="post" id="form">
        <input type="hidden" name="company" value="<?php echo $company; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
          <div class="employee_list">
              <button v-for="friend in friends" class="list" name="emplist" value="{{ friend.id }}">
                <div class="list_name">
                  <p>{{ friend.division }}</p>
                <p>{{ friend.kana }}</p>
                  <span>
                    {{ friend.name }}
                  </span>
                <!-- <p>{{ friend.nickname }}</p> -->
                </div>
                <img src="./img/member/{{ friend.id }}.jpg">
              </button>
          </div>
      <ul class="initial_list">
        <li class="initial">あ</li> 
        <li class="initial">か</li>
        <li class="initial">さ</li>
        <li class="initial">た</li>
        <li class="initial">な</li>
        <li class="initial">は</li>
        <li class="initial">ま</li>
        <li class="initial">や</li>
        <li class="initial">ら</li>
        <li class="initial">わ</li>
      </ul>
      <a href="company.php" class="back">戻る</a>
</div>
</body>
</html>
