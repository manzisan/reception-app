<?php
  $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

  $title = "コード入力";
  include_once "../layout/meta.php";
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
      <?php if($error == 1): ?>
        <p class="error">該当のコードが存在しません。再度入力して下さい。</p>
        <style>
          .number_list{
            /* margin-top:-20px; */
          }
        </style>
      <?php endif ?>
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
          <button class="button-number">0</button>
        </div>
      </div>
      <div class="footer-btn-list">
        <button onClick="location.href='index.php'" class="back">戻る</button>
        <button onClick="location.href='company.php'" class="forget">コードをお忘れの方</button>
        <button onclick="$('#form').submit();" class="next">次へ</button>
      </div>
    </div>
  </div>
</body>
<script>
  var b_number = document.getElementsByClassName('button-number');
  // var num = document.forms.form.numberform.value;
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
</script>
</html>
