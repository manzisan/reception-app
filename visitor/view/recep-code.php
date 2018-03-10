<?php
  $title = "コード入力";
  include_once "../component/meta.php";
?>
<body id="code">
  <div id="wrapper">
    <div class="inner">
      <h1>４桁の招待コードを入力してください</h1>
      <form action="call.php" method="post" id="form">
        <input type="text" id="number-form" value="" name="code" readonly>
        <span id="delete-button">
          <i class="fa fa-times" aria-hidden="true"></i>
        </span>
      </form>
      <div class="btn-column">
        <div class="btn-row">
          <button class="button-number">1</button>
          <button class="button-number">2</button>
          <button class="button-number">3</button>
        </div>
        <div class="btn-row">
          <button class="button-number">4</button>
          <button class="button-number">5</button>
          <button class="button-number">6</button>
        </div>
        <div class="btn-row">
          <button class="button-number">7</button>
          <button class="button-number">8</button>
          <button class="button-number">9</button>
        </div>
        <div class="btn-row">
          <button class="button-number" style="visibility: hidden;"></button>
          <button class="button-number">0</button>
          <button class="button-number" style="visibility: hidden;"></button>
        </div>
      </div>
      <div class="footer-btn-list">
        <a href="index.php" class="back">戻る</button>
        <a href="company.php" class="forget">コードをお忘れの方</a>
        <a class="next" id="submit">検索</a>
      </div>
    </div>
    <div id="loader" class="loader">
      <div class="loader-animation"></div>
    </div>
  </div>
</body>
<script src="../src/js/alertify.js"></script>
<script>
  var b_number = document.getElementsByClassName('button-number');
  var d_button = document.getElementById('delete-button');
  var n_form = document.getElementById('number-form');
  var inputValue = "";
  for (var i = 0; i < b_number.length; i++) {
    b_number[i].addEventListener('click',function(e){
      if (inputValue.length === 4) {
        return;
      }
      e.preventDefault();
      inputValue += this.innerHTML;
      n_form.value　=　inputValue;
    });
    b_number[i].addEventListener('click',function(e){
      e.preventDefault();
    });
  }
  d_button.addEventListener('click',function(e){
    e.preventDefault();
    inputValue　=　inputValue.slice(0,-1);
    n_form.value = inputValue;
  });
  if (window.location.search == "?error=1") {
    setTimeout(()=>{
      alertify.error("入力されたコードは存在しません。<br>お手数ですが再度ご入力ください。");
    },300);
  }
  $('#submit').on("click",()=> {
    if (n_form.value.length == 0) {
      alertify.error("コードが入力されていません。");
    } else if (n_form.value.length != 4) {
      alertify.error("コードを４桁で入力してください。");
    } else {
      $('#form').submit();
    }
  });
</script>
</html>