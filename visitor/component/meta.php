<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="img/icon.jpg">
  <script src="https://code.jquery.com/jquery-3.2.0.js" integrity="sha256-wPFJNIFlVY49B+CuAIrDr932XSb6Jk3J1M22M3E2ylQ=" crossorigin="anonymous"></script>
  <script src="../src/js/vue.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../src/css/style.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <title><?php echo $title; ?> | 社内受付</title>
</head>
<script>
  $(window).on('touchmove.noScroll', (e)=> {
    e.preventDefault();
  });

  $(()=> {

    setTimeout(()=> {
      $('#loader').fadeOut(400); 
    },300);

    $('a[href^="#"]').click(()=> {
      var url = $(this).attr('href');
      $('#loader').fadeIn(600);
      setTimeout(()=> {
        location.href = url;
      }, 800);
      return false;
    });
    
  });
</script>