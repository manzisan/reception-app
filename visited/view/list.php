<?php
  include("../../dbconnection/config.php");
  include("../../dbconnection/connect.php");

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

  $title = "呼び出し";
  include_once "../layout/meta.php";
?>
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
          <div class="list-row">
            <div class="list-name">
              <p class="divi">{{ friend.division }}</p>
              <p class="kana">{{ friend.kana }}</p>
              <span class="name">{{ friend.name }}</span>
            </div>
            <div class="list-image">
              <img src="../src/img/member/1.jpg">
            </div>
          </div>
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
    </form>
  </div>
</body>
<script>
  $(function(){
    var friends = <?php echo json_encode($friends);?>;
    console.log(friends);
    var namelist = {
      friends: friends,
      search: ""
    };
    var myViewModel = new Vue({
      el: '.employee_list',
      data: namelist
    });
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
        var filteredFriends = friends.filter(function(friend) {
          console.log(friend.kana,friend.kana.charAt(0),list.indexOf(friend.kana.charAt(0)) !== -1)
          return (list.indexOf(friend.kana.charAt(0)) !== -1);
        });
        myViewModel.friends = filteredFriends;
      });
    }
  });
</script>
</html>
