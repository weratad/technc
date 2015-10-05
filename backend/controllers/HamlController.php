<?php

namespace backend\controllers;

class HamlController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$params = array(
    			'users'=> array('1','2')
    	);
    	$this->layout =  'main-layout.haml';
        return $this->render('index.haml', $params);
    }

}
