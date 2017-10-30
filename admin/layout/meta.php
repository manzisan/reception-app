<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../src/css/style.css">
<script src="https://code.jquery.com/jquery-3.2.0.js" integrity="sha256-wPFJNIFlVY49B+CuAIrDr932XSb6Jk3J1M22M3E2ylQ=" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="../src/js/vue.min.js"></script>
<title><?php echo $title; ?> | 管理画面</title>
</head>
<script>
  $(function () {
    var dateFormat = 'yy-mm-dd';
    $('#datepicker').datepicker({
      dateFormat: dateFormat
    });
  });
</script>