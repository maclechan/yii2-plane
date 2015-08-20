<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\web\Session;

/* @var $this \yii\web\View */
/* @var $content string */

use backend\components\NavWidget;
use backend\components\NavbarWidget;

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

<!-- nav -->
<?= NavWidget::widget() ?>

<div id="wrapper">
	
    <!-- navbar --> 
    <?php 
    	//一级菜单id和en传给二级小部件使用
    	if(isset($_GET['fid']) || isset($_GET['en'])){
    		//设置一个新session变量
    		$session['fid'] = $_GET['fid'];
    		$session['en'] = $_GET['en'];
    		// 获取session中的变量值
    		$fid = $session['fid'];
    		$en = $session['en'];
    	}elseif (isset($session['fid']) || isset($session['en'])) {
    		// 获取session中的变量值
    		$fid = $session['fid'];
    		$en = $session['en'];
    	}else{
    		$fid = 2;
    		$en = 'shop';
    	}
    ?>
    <?= NavbarWidget::widget(['fid'=>$fid,'en'=>$en]) ?>

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
