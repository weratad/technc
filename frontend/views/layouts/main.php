<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <header>
        <div class="hd-top">
            <div class="container">
                <span>
                    <a href="">Link</a>
                    <a href="">Link</a>
                    <a href="">Link</a>
                    <a href="">Link</a>
                </span>
            </div><!--.container-->
        </div><!--.hd-top-->
        <div class="hd-cont container">
            <div class="hd-cont-logo">
                <dl class="logo">
                    <dt>
                        <a href=""><img src="http://2800.10yanw.com/templets/default/images/logo12.png"></a>
                    </dt>
                    <dd>
                        <p>十年的魅力演绎</p>
                        <h2>健康环保办公家具第一品牌</h2>
                    </dd>
                </dl>
            </div>
            <dl class="phone">
                <dt>全国服务热线</dt>
                <dd>400-900-8899</dd>
            </dl>
        </div><!--.hd-cont-->
        <div class="hd-nav">
            <ul class="container">
                <li>
                    <a href="/">公司首页</a>
                </li>
            </ul>
        </div><!--.hd-nav-->
    </header>
    <div class="banner">
        <div id="carousel-generic" class="carousel slide carousel-fade" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-generic" data-slide-to="1"></li>
            <li data-target="#carousel-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
              <img src="http://2800.10yanw.com/templets/default/images/banner.jpg" alt="...">
              <div class="carousel-caption">
              </div>
          </div>
          <div class="item">
              <img src="http://2800.10yanw.com/templets/default/images/banner1.jpg" alt="...">
              <div class="carousel-caption">
              </div>
          </div>
          <div class="item">
              <img src="http://2800.10yanw.com/templets/default/images/banner.jpg" alt="...">
              <div class="carousel-caption">
              </div>
          </div>
      </div><!--#carousel-generic-->
  </div> <!-- Carousel -->

</div><!--.banner-->
<div class="bgspan">
    <div></div>
</div>
<div class="search-home">
    <div class="search container">
        <span class="keyword">
            <span>热门搜索：</span>
            <em>
                <a href="/">办公家具</a>
            </em>
        </span>
    </div>
</div>
<div class="pattern">
    555+
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
