
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\ChatRead();
  $app->run();
  $requestPage = 'CHAT -';
  $jsPath = './../js/chat.js';
  $CSSPath1 = './../CSS/chat.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  
  require_once(__DIR__ . '/head.php');

  ?>
