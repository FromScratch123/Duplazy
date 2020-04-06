
<?php 
  require_once(__DIR__ . '/../config/config.php');
  trackingStart();

  $app = new MyApp\Controller\Home();
  $app->run();
  $work = new MyApp\Controller\WorkDetails();
  $work->run();




  $requestPage = 'HOME -';
  $jsPath1 = './../js/home.js';
  $jsPath2 = './../js/aside.js';
  $jsPath3 = './../js/uploadWork.js';
  $jsPath4 = './../js/workDetails.js';
  $CSSPath1 = './../CSS/home.css';
  $CSSPath2 = './../CSS/accountField.css';
  $CSSPath3 = './../CSS/aside.css';
  $CSSPath4 = './../CSS/uploadWork.css';
  $CSSPath5 = './../CSS/workDetails.css';

  
  require_once(__DIR__ . '/head.php');

  ?>

<body>
<?php 
$logoPath = './home.php';
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
  <div class="work-window">
  <div class="work-details">
    <span class="times"><i class="close-icon fas fa-times"></i></span>
    <div class="work-details-wrap--flex flex-container">
      <div class="flex-item1">
        <div class="work-details__img-wrap">
          <img src="<?= isset($work->getProperties('_work')->work) ? h($work->getProperties('_work')->work) : './../images/default_work_thumbnail.jpg'; ?>" alt="" class="work-details__img">
        </div>
      </div>
      <div class="flex-item2">
      <p class="has-error margin--0"><?= $work->getErrors('common'); ?></p>
        <!-- title -->
        <p class="work-details__title margin--0">
          <?= isset($work->getProperties('_work')->title) ? h($work->getProperties('_work')->title) : ""; ?>
        </p>
        <!-- category -->
        <p class="work-details__category">
          <?= isset($work->getProperties('_work')->name) ? h($work->getProperties('_work')->name) : ""; ?>
        </p>
        <!-- description -->
        <p class="work-details__description">
          <?= isset($work->getProperties('_work')->description) ? h($work->getProperties('_work')->description) : ""; ?>
        </p>
        <!-- comment -->
        <p class="has-error margin--0"><?= $work->getErrors('empty'); ?></p>
        <div class="work-details__comment">
            <?php for($i = 0; isset($work->getProperties('_comment')->$i); $i++) : ?>
              <table>
                <tbody>
                  <tr>
                    <td>
                      <div class="comment-user-icon-wrap">
                        <a href="./profile.php?u=<?= isset($work->getProperties('_comment')->$i) ? h($work->getProperties('_comment')->$i->id) : "" ?>">
                        <img class="comment-user-icon__img" src="<?= isset($work->getProperties  ('_comment')->$i->profile_img) ? h($work->getProperties('_comment')->$i->profile_img) : './../images/default_user_icon.png' ?>" alt="ユーザーのアイコン画像">
                      </a>
                      </div>
                    </td>
                    <td>
                       <p class="work-details__comment-text">
                       <?= h($work->getProperties('_comment')->$i->comment) ?>
                       </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            <?php endfor; ?>
        </div>
        <form action="" method="post">
         <textarea name="comment" class="work__textarea" placeholder="leave a comment"></textarea>
         <!-- token -->
         <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input class="work-submit" type="submit" value="work" class="work-submit">
        </form>
      </div>
    </div>
  </div>
        
  <div class="window-mask"></div>

</div>
</main>
</body>
</html>