<?php

namespace backend\controllers;

class DemoController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'layout-iframe';
        return $this->render('index');
    }

}
