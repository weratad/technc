<?php
/* @var $this yii\web\View */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/demo/index.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\AngularAsset']]);
?>
<div ng-controller="ChildController">
<h1>demo/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
 <p><button ng-click="message()">Send message to parent</button>
    <p>Messages from parent</p>
    <ul>
      <li ng-repeat="message in messages track by $index">{{message}}</li>
    </ul>
</div>
