<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title= '代理系统-后台登陆';
AppAsset::register($this);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= Html::encode($this->title) ?></title>
</head>

<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">A+</h1>
            </div>
            <h3>Welcome to agent system</h3>
            <p></p>
            <?php $form = ActiveForm::begin(['id' => 'login-form','options' => [ 'enctype' => 'multipart/form-data' ]]); ?>
                <div class="form-group">
                    <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('请输入帐号')]])->label(false) ?>
                </div>                
                <div class="form-group">
                   <!--  <input type="password" class="form-control" placeholder="请输入密码" required=""> -->
                    <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('请输入密码')]])->passwordInput()->label(false) ?>
                </div>
                <div class="form-group">
                        <?= $form->field($model, 'rememberMe')->checkbox()->label('记住密码') ?>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登陆</button>
            <?php ActiveForm::end(); ?>
            <p class="m-t"> <small>管理系统  &copy; 2015</small> </p>
        </div>
    </div>

</body>

</html>

