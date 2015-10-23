<?php
/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.write('<base href="' + document.location + '" />');</script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<div id="iframe-page" >
		<?=$content?>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
