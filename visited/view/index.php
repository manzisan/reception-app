<?php
  $title = "呼び出し";
  include_once "../layout/meta.php";
?>
<body>
<div id="wrapper">
  <img src="../src/img/logo.png" alt="logo">
  <p class="clock"></p>
  <p class="day"></p>
  <div class="button_list">
    <a href="recepcode.php">打ち合わせ</a>
    <a href="sales.php">営業</a>
    <a href="waitdeli.php">宅配</a>
    <a href="waitother.php">その他</a>
  </div>
</div>
</body>
<script>
  var clockE = document.getElementById('clock');
  var dayE = document.getElementById('day');

  var clock = () => {
    var myDay = new Array("日","月","火","水","木","金","土");
    var now  = new Date();
    var month = now.getMonth()+1;
    var date = now.getDate();
    var day = now.getDay();
    var hour = now.getHours();
    var min  = now.getMinutes();

    if(hour < 10) {
      hour = "0" + hour;
    }
    if(min < 10) {
      min = "0" + min;
    }
    if(sec < 10) {
      sec = "0" + sec;
    }

    clockE.innerHTML = hour + ':' + min;
    dayE.innerHTML = month + '月' + date + "日" +'（' + myDay[day] + '曜日）';
  }
  setInterval(clock(),1000);
</script>
</html>
