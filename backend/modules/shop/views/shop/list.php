<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商户管理']);
$this->registerMetaTag(['name' => 'description', 'content' => '商户管理'], 'description');
$this->title= '代理系统-商家管理';
$this->params['breadcrumbs'][] = '商家管理';
$this->params['breadcrumbs'][] = '商家中心';
$this->params['breadcrumbs'][] = '商户管理';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
<?php 
use kartik\export\ExportMenu;
//菜单展示
    $gridColumns = [    
        //['class' => 'yii\grid\SerialColumn'],
        'id',
        'username',
        'email',
        'legalname',
        'phone',
        'compname',
    ];
echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
        'columnSelectorOptions'=>[
            'class' => 'btn btn-sm btn-primary',
        ],
        'dropdownOptions' => [
            'icon'=>'<i class="glyphicon glyphicon-export"></i>',
            'label' => '导出',
            'class' => 'btn btn-sm btn-primary'
        ],
        'exportConfig' => [//禁止PDF TEXT格式导出
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_PDF => false
        ]
    ]);      

?>

<?php 
//数据展示
use yii\grid\GridView;
   echo GridView::widget([
    
         'dataProvider' => $dataProvider,
         'columns' => [
             'id',
            'username',
            'email',
            'legalname',
            'phone',
            'compname',//(attribute为字段的名称，开发时候根据自己的需要进行修改)
            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '80']],
         ],
]);
 ?>
</div>