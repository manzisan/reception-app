<?php
  $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
  $url = pathinfo($url);

  switch ($url['filename']) {
    case 'recep-code':
      echo "recep-code";
      break;
    
    default:
      # code...
      break;
  }