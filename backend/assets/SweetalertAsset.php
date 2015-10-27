<?php
namespace backend\assets;

use yii\web\AssetBundle;
class SweetalertAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert';
    public $css = [
    	'dist/sweetalert.css',
    	'themes/facebook/facebook.css'
    ];
    public $js = [
    	'dist/sweetalert-dev.js'
    ];
    public $depends = [];
}
