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
<div class="pattern container">
    <ul id="flexisel">
        <li><img src="images/1.jpg" /></li>
        <li><img src="images/2.jpg" /></li>
        <li><img src="images/3.jpg" /></li>
        <li><img src="images/4.jpg" /></li>
    </ul>
</div>

<div class="product-intro container">
<div class="main margin">
  <div class="mainTitle f1">
    <h4><span></span><strong><a href="category.php?id=1" target="_blank">水果/干果</a></strong></h4><div class="titleMenu"><a href="category.php?id=2">CD草莓</a><span>|</span><a href="category.php?id=3">樱桃</a><span>|</span><a href="category.php?id=4">枣</a><span>|</span><a href="category.php?id=5">双桂圆龙眼</a><span>|</span><a href="category.php?id=22">芭蕉</a></div>  </div>
  <div class="floor_bd clearfix">
    <div class="indexLeft f1">
      <div class="indexLeftYY"></div>
      <p><a href="affiche.php?ad_id=10&amp;uri=" target="_blank"><img src="data/afficheimg/1381750269676365518.jpg" width="198" height="276" border="0"></a></p>
      <ul class="clearfix">
         <li><a href="category.php?id=1&amp;brand=1" target="_blank"><img src="data/brandlogo/1381749724728245700.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=2" target="_blank"><img src="data/brandlogo/1381749752946770742.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=3" target="_blank"><img src="data/brandlogo/1381749818694455891.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=4" target="_blank"><img src="data/brandlogo/1381749859741523999.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=5" target="_blank"><img src="data/brandlogo/1381750057845372355.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=6" target="_blank"><img src="data/brandlogo/1381750086837009405.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=7" target="_blank"><img src="data/brandlogo/1381750122411713668.jpg" width="97" height="67" border="0"></a></li><li><a href="category.php?id=1&amp;brand=8" target="_blank"><img src="data/brandlogo/1381750153769476845.jpg" width="97" height="67" border="0"></a></li>      </ul>
    </div>
    <div class="indexRight">
      <ul class="clearfix">
        <li>
          <div class="img"><a href="goods.php?id=33"><img src="images/201310/thumb_img/33_thumb_G_1381749971338.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>800.00</strong><del>￥960.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=33">湘妹子 阿婆糍粑（枣仁花生）湖南张家界特产 200g 糕点 点心  味道...</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=34"><img src="images/201310/thumb_img/34_thumb_G_1381753249228.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>700.00</strong><del>￥840.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=34">南兴天虹 盐焗开心果 广东佛山特产 480g 开心果</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=37"><img src="images/201310/thumb_img/37_thumb_G_1381753166160.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>600.00</strong><del>￥720.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=37">湘川园 香芋酥（香芋味）湖南张家界特产 200g 酥 糕点 点心 酥软松...</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=41"><img src="images/201310/thumb_img/41_thumb_G_1381753202195.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>500.00</strong><del>￥600.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=41">火宫殿 五香干 湖南长沙特产 150g 豆腐干 营养丰富，味道可口</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=45"><img src="images/201310/thumb_img/45_thumb_G_1381753099368.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>400.00</strong><del>￥480.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=45">湖湘贡 精装土家腊肉 湖南长沙特产 100g 肉干 风味独特</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=46"><img src="images/201310/thumb_img/46_thumb_G_1381752155882.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>300.00</strong><del>￥360.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=46">耶啰耶 兔肉丁 （香辣味） 湖南怀化特产 108g 休闲小吃 质地细嫩，...</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=48"><img src="images/201310/thumb_img/48_thumb_G_1381753037667.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>200.00</strong><del>￥240.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=48">仁仔 湘味熏肠 湖南长沙特产 300g 腊肠 齿颊留香 沁人心脾</a></div>
        </li><li>
          <div class="img"><a href="goods.php?id=52"><img src="images/201310/thumb_img/52_thumb_G_1381751835654.jpg"></a></div>
          <div class="price_wrap"><strong><span>￥</span>100.00</strong><del>￥120.00</del></div>
          <div class="title_wrap"><a target="_blank" href="goods.php?id=52">牛浪汉 牛肉粒（麻辣味）重庆特产 80g 牛肉 牛肉干 香辣 麻辣 营养...</a></div>
        </li>      </ul>
      <div class="SalesRank f1">
        <div class="SalesRankTitle">热销排行</div>
        <dl>
          <dt><a href="goods.php?id=48" target="_blank"><img src="images/201310/thumb_img/48_thumb_G_1381753037667.jpg"></a></dt>
          <dd>
            <div class="price_wrap"><span>￥</span>200.00</div>
            <div class="title_wrap"><a href="goods.php?id=48">仁仔 湘味熏肠 湖南长沙特产 300g 腊肠 齿颊留香 沁人心脾</a></div>
          </dd>
        </dl><dl>
          <dt><a href="goods.php?id=46" target="_blank"><img src="images/201310/thumb_img/46_thumb_G_1381752155882.jpg"></a></dt>
          <dd>
            <div class="price_wrap"><span>￥</span>300.00</div>
            <div class="title_wrap"><a href="goods.php?id=46">耶啰耶 兔肉丁 （香辣味） 湖南怀化特产 108g 休闲小吃 质地细嫩，...</a></div>
          </dd>
        </dl><dl>
          <dt><a href="goods.php?id=41" target="_blank"><img src="images/201310/thumb_img/41_thumb_G_1381753202195.jpg"></a></dt>
          <dd>
            <div class="price_wrap"><span>￥</span>500.00</div>
            <div class="title_wrap"><a href="goods.php?id=41">火宫殿 五香干 湖南长沙特产 150g 豆腐干 营养丰富，味道可口</a></div>
          </dd>
        </dl>        <div class="SalesRankAd"><a href="affiche.php?ad_id=11&amp;uri=" target="_blank"><img src="data/afficheimg/1381657822382871599.jpg" width="199" height="135" border="0"></a></div>
        <div class="SalesRankAd1"><a href="affiche.php?ad_id=12&amp;uri=" target="_blank"><img src="data/afficheimg/1381657841395974682.jpg" width="199" height="135" border="0"></a></div>
      </div>
    </div>
  </div>
</div>
</div><!--product-intro-->
<?php $this->endBody() ?>
<script type="text/javascript">

$(window).load(function() {
    $("#flexisel").flexisel({
        visibleItems: 6,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
    });
});
</script>

</body>
</html>
<?php $this->endPage() ?>
