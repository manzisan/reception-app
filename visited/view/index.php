<?php
  $title = "トップ";
  include_once "../layout/meta.php";
?>
<body id="top">
<div id="wrapper">
  <img src="../src/img/logo.png" alt="logo" id="logo">
  <p id="clock"></p>
  <p id="day"></p>
  <div class="btn-column">
    <a href="recepcode.php">アポイントメント<br>有りの方</a>
    <a href="sales.php">アポイントメント<br>無しの方</a>
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

    clockE.innerHTML = hour + ':' + min;
    dayE.innerHTML = month + '月' + date + "日" +'（' + myDay[day] + '曜日）';
  }
  setInterval(clock(),1000);
</script>
</html>
