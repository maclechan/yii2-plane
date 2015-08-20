<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$this->context->layout = false;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= Html::encode($this->title) ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="awesome/css/awesome.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h2><?= Html::encode($this->title) ?></h2>
        <h3 class="font-bold"><?= nl2br(Html::encode($message)) ?></h3>

        <div class="error-desc">
            您很有可能己经跑到另一国度开垦去了！<i class="fa fa-pied-piper-alt fa-5x"></i> 
            <form class="form-inline m-t" role="form">
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Go Back</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
