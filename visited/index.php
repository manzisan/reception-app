<?php
  $title = "呼び出し";
  include_once "layout/meta.php";
?>
<body>
  <script>

    function clock() {
      var myDay = new Array("日","月","火","水","木","金","土");
      var now  = new Date();
      var year = now.getFullYear(); // 年
      var month = now.getMonth()+1; // 月
      var date = now.getDate(); // 日
      var day = now.getDay();
      var hour = now.getHours(); // 時
      var min  = now.getMinutes(); // 分
      var sec  = now.getSeconds(); // 秒

      // 数値が1桁の場合、頭に0を付けて2桁で表示する指定
      if(hour < 10) { hour = "0" + hour; }
      if(min < 10) { min = "0" + min; }
      if(sec < 10) { sec = "0" + sec; }

      // フォーマット①
      
      var clock = document.getElementsByClassName('clock');
      var day2 = document.getElementsByClassName('day');


      clock[0].innerHTML = hour + ':' + min ;
      day2[0].innerHTML = month + '月' + date + "日" +'（' + myDay[day] + '曜日）';
      
      // document . getElementById( 'clock-02' ) . innerHTML= clock2 . toLocaleString(); // div id="clock-02"

      // 1000ミリ秒ごとに処理を実効
      window . setTimeout( "clock()", 1000);
    }
    window . onload = clock;
  </script>
<div id="wrapper">
  <img src="img/logo.png" alt="logo">
  <p class="clock">11:25</p>
  <p class="day"></p>
    <div class="button_list">
      <a href="recepcode.php">打ち合わせ</a>
      <a href="sales.php">営業</a>
      <a href="waitdeli.php">宅配</a>
      <a href="waitother.php">その他</a>
    </div>
</div>
</body>
</html>
