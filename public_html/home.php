
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Home();
  $app->run();
  $upload = new MyApp\Controller\UploadWork();
  $upload->run();

  $requestPage = 'HOME -';
  $jsPath1 = './../js/home.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = '';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';

  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = '';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/accountField.php');
require_once(__DIR__ . '/aside.php');
 ?>

<!-- message -->
<?php if (!empty($_SESSION['messages'])) : ?>
  <div class="message">
    <p class="message__text"><?= h($app->getMessage($_SESSION['messages']))  ?></p>
  </div>
<?php endif; ?>
  
<main>
  <div class="project-window">
  <?php require_once(__DIR__ . '/uploadWork.php'); ?>
    <div class="my-project-area--flex flex-container">
      <?php for ($i = 0; isset($app->getProperties('_myProject')->$i); $i++) : ?>
      <div class="my-project">
        <div class="project-img-wrap">
          <img class="project__img" src="<?= isset($app->getProperties('_myProject')->$i->thumbnail) ? h($app->getProperties('_myProject')->$i->thumbnail) : '' ?>" alt="">
        </div>
        <p class="margin--0"><?= isset($app->getProperties('_myProject')->$i) ? mb_substr(h($app->getProperties('_myProject')->$i->title), 0, 10, "UTF-8") . "..." : ""; ?></p>
        <p class="margin--0"><?= isset($app->getProperties('_myProject')->$i->modified_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_myProject')->$i->modified_date))) : "" ?></p>
      </div>
      <?php endfor; ?>
    </div>

    <div id="tool-bar" class="tool-bar--flex flex-container">
      <div class="tool-bar__breadcrumbs">
        <span>Home >> My Project >> 最近使用したファイル</span>
      </div>
      <div class="tool-bar__sort">
        <ul class="tool-bar__sort--flex flex-container">
          <li class="sort-icon"><i class="fas fa-sort-alpha-down"></i></li>
          <li class="sort-icon"><i class="fas fa-sort-alpha-up"></i></li>
          <li class="sort-icon"><i class="far fa-clock"></i></li>
        </ul>
      </div>
    </div>

    <div class="others-project-area">
      <?php for ($i = 0; isset($app->getProperties('_othersProject')->$i); $i++) : ?>
      <div class="others-project--flex flex-container">
        <!-- project img -->
        <div class="project-img-wrap">
          <a href="">
            <img src="<?= isset($app->getProperties('_othersProject')->$i->work) ? h($app->getProperties('_othersProject')->$i->work) : ''; ?>" alt="" class="project__img">
          </a>
        </div>

        <div class="project-info-wrap">
          <!-- project title -->
          <div class="project-title">
                <p class="project-title__text margin--0">
                 <a href="">
                  <?= isset($app->getProperties('_othersProject')->$i->title) ? h($app->getProperties('_othersProject')->$i->title) : '' ?>
                 </a>
                </p>
          </div>
           <!-- project description -->
           <div class="project-description">
              <p class="project-description__text margin--0">
                 <a href="">
                    <?= isset($app->getProperties('_othersProject')->$i->description) ? mb_substr(h($app->getProperties('_othersProject')->$i->description), 0, 100, "UTF-8") . "..." : "説明文はありません"  ?>
                 </a>
              </p>
           </div>
           <!-- others icon -->
           <div class="others-info-wrap--flex flex-container">
             <div class="others-icon-wrap">
              <a href="./profile.php?u=<?= isset($app->getProperties('_othersProject')->$i) ? h($app->getProperties('_othersProject')->$i->id) : "" ?>">
                  <img class="others-icon__img" src="<?= isset($app->getProperties  ('_othersProject')->$i->profile_img) ? h($app->getProperties('_othersProject')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
               1   </a>
               </div>
  
           <!-- ohters name -->
              <div class="others-name">
                <p class="others-name__text">
                  <a href="./profile.php?u=<?= isset($app->getProperties('_othersProject')->$i) ? h($app->getProperties('_othersProject')->$i->id) : "" ?>">
                    <?= $app->getProperties('_othersProject')->$i->surname && $app->getProperties('_othersProject')->$i->givenname ? h($app->getProperties('_othersProject')->$i->surname) . " " . h($app->getProperties('_othersProject')->$i->givenname) : "" ?>
                  </a>
                </p>
              </div>
           </div>
         </div>

        <div class="time">
          <p class="time__text margin--0">
             <?= isset($app->getProperties('_othersProject')->$i->modified_date) ? date('m月d日 H:i', strtotime(h($app->getProperties('_othersProject')->$i->modified_date))) : "" ?>
          </p>
        </div>

        <!-- others menu -->
        <div class="others-menu">
            <i id="others-menu-trigger" class="others-menu-trigger fas fa-ellipsis-h">
              <div class="others-menu-box js--hidden">
                  <ul>
                    <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == 1) : ?>
                    <li class="others-menu-list">
                        <a href="./createRoom.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">メッセージ</a>
                    </li>
                    <li class="others-menu-list">
                      <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達解除</a>
                    </li>
                    <?php endif; ?>
                    <?php if (isset($app->getProperties('_friends')->$i) && $app->getProperties('_friends')->$i->accept_flg == false && $app->getProperties('_friends')->$i->follow_user !== $_SESSION['me']->id) : ?>
                    <li class="others-menu-list">
                        <a href="./acceptFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請承諾</a>
                    </li>
                    <li class="others-menu-list">
                        <a href="./deleteFriend.php?u=<?= isset($app->getProperties('_friends')->$i) ? h($app->getProperties('_friends')->$i->id) : "" ?>">友達申請拒否</a>
                      </li>
                      <?php endif; ?>
                      <li class="others-menu-list">
                        <a href="">ヘルプ</a>
                      </li>
                  </ul>
                </div> 
              </i>
        </div>
      </div>
      <?php endfor; ?>
      <footer class="footer">
        
      </footer>
    </div>
  </div>

</main>
</body>
</html>