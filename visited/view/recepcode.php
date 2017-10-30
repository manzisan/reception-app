<?php
  $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
  echo $error;

  $title = "コード入力";
  include_once "../layout/meta.php";
?>
<body>
  <div id="wrapper">
    <div class="inner">
    <h1>４桁の招待コードを入力してください</h1>
    <form action="call.php" method="post" id="form">
      <input type="text" id="number_form" value="" name="code" readonly>
      <span id="delete_button">×</span>
      <?php
        if($error == 1){
          echo "<p class=\"nonecode\">該当のコードが存在しません。再度入力して下さい。</p>
          <style>
            .number_list{
              margin-top:-20px;
            }
          </style>";

        }else{
          echo "";
        }
      ?>

      <div class="number_list">
        <div class="button_number">1</div>
        <div class="button_number">2</div>
        <div class="button_number">3</div>
        <div class="button_number">4</div>
        <div class="button_number">5</div>
        <div class="button_number">6</div>
        <div class="button_number">7</div>
        <div class="button_number">8</div>
        <div class="button_number">9</div>
        <div class="button_number">0</div>
      </div>
      <div class="a_list">
        <a href="company.php" class="forget">招待コードをお忘れの方</a>
        <a href="index.php" class="back">戻る</a>
      </div>
      <input type="submit" class="next" value="次へ">
    </form>
    </div>
  </div>
</body>
<script>
  window.onload=function()　{
    var b_number = document.getElementsByClassName('button_number');
    var num = document.forms.form.number_form.value;
    var d_button = document.getElementById('delete_button');
    var n_form = document.getElementById('number_form');
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
  }
</script>
</html>
