<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
        <div class="header-top-fix">
         </div><!--.header-top-fix-->
            <div class="header-context">
                <div class="roof"></div><!--.roof-->
                <div class="logo-main"></div><!--.logo-main-->
                <div class="menumain">
                    <ul class="nav">
                        <li class="active">
                            <a href="">
                                <div><?=Html::img(Url::base().'/images/icons/box.png')?></div>
                                <span>ข้อมูลทั่วไป</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div><?=Html::img(Url::base().'/images/icons/box.png')?></div>
                                <span>ข้อมูลทั่วไป</span>
                            </a>
                        </li>
                    </ul>
                </div><!--.menumain-->
            </div><!--.header-context-->
    </header>
    <aside>
        <nav>
            <ul>
                <li>
                    <a href="">
                        <?=Html::img(Url::base().'/images/icons/house.png')?>
                        <span>แจ้งความเสี่ยง</span>
                    </a>
                </li>
                <li class="dropdown active">
                    <a href="">
                        <?=Html::img(Url::base().'/images/icons/house.png')?>
                        <span>แจ้งความเสี่ยง</span>
                    </a>
                    <ul class="dropdown-list">
                        <li>
                            <a href="">
                                <span>สินค้าทั้งหมด</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="">
                                <span>เพิ่มสินค้า</span>
                            </a>
                        </li>
                    </ul>
                </li>
                      <li class="dropdown">
                    <a href="">
                        <?=Html::img(Url::base().'/images/icons/house.png')?>
                        <span>แจ้งความเสี่ยง</span>
                    </a>
                    <ul class="dropdown-list">
                        <li>
                            <a href="">
                                <span>สินค้าทั้งหมด</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span>เพิ่มสินค้า</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <section>
        <article>
            <div class="breadcrumb">
                <div class="breadcrumb-title">
                    <p class="en">PRODUCTS</p>
                    <p class="th">จัดการสินค้า</p>
                </div>
            </div>
            <div class="content">
                <?=$content?>
            </div>
        </article>
    </section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
