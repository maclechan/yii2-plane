<?php
use agent\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this \yii\web\View */
/* @var $content string */

use agent\components\NavWidget;

AppAsset::register($this);
$session = Yii::$app->session;
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

<?php
   NavBar::begin([
        'brandLabel' => Yii::$app->user->identity->compname,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse ',
            'id' => 'menu-top',
        ],
        //'brandOptions' => ['class' => 'fa fa-trophy fa-2x'],

    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登陆', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => '欢迎您，'.Yii::$app->user->identity->username,
              'items' => [
                   [
                    'label' => ' 退出',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post','class'=>'fa fa-sign-out'],                    
                   ],
             ],
        ];

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,

    ]);
    NavBar::end();
?>

<div id="wrapper">
	
    <!-- nav --> 
    <?= NavWidget::widget() ?>

    <!--右侧内容-->
    <div id="page-wrapper" class="gray-bg dashbard-1">

	    <!--Breadcrumbs-->
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-9">
			    <h6>Welcome To Admin System  </h6>
				<?= Breadcrumbs::widget([
					'homeLink'=>['label' => '首页','url' => Yii::$app->homeUrl,'template' => "<li><a class='navbar-minimalize '><i class='fa fa-anchor fa-spin fa-2x'></i></a> &nbsp;{link} </li>\n",],
	            	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	        	]) ?>
	        </div>
    	</div>
		<!--Breadcrumbs-->
	
   		<?= $content ?>

		<div class="footer ">
	        <div class="pull-right"> <strong>chan</strong> 13251079793.</div>
	        <div><strong>Copyright</strong> chan Company &copy; 2014-2015</div>
	    </div>

	<div>
   <!--右侧内容-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
