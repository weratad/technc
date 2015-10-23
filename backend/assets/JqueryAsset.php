<?php
namespace backend\assets;

use yii\web\AssetBundle;
class JqueryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
      'js/jquery/jquery.cookie.js',
     // 'js/jquery/jquery.mockjax.js',
    ];
    public $depends = [];
}
