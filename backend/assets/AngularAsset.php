<?php
namespace backend\assets;

use yii\web\AssetBundle;
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower/angular';
    public $css = [];
    public $js = [
      //  'angular.min.js',
    ];
    public $depends = [];
}
