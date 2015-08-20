<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商品品牌']);
$this->registerMetaTag(['name' => 'description', 'content' => '商品品牌'], 'description');
$this->title= '代理系统-商品品牌';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '商品品牌';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品品牌</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                    <a href="<?=Url::toRoute(['brandadd']) ?>" data-toggle="modal"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加类别" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加品牌</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>品牌名称</th>
                        <th>品牌LOGO</th>
                        <th>品牌网址</th>
                        <th>是否显示</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($brand)){ 
                            foreach ($brand as $_v) {              
                    ?>
                    <tr>
                        <td><?= $_v->name?></td>
                        <td><img src="<?= $_v->logo;?>" class="img-circle" width="30" /></td>
                        <td><?= $_v->url?></td>
                        <td><?= $_v->is_show == 1 ? '<i class="bule-1 fa fa-check"></i>':'<i class="red-1 fa fa-times"></i>' ?></td>
                        <td><?= $_v->sort?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            ['brandedit', 'id' =>  $_v->id], 
                                            ['class' => 'btn btn-default btn-xs',
                            ]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                        ['brandel', 'id' =>  $_v->id], 
                                        ['class' => 'btn btn-default btn-xs',
                                        'data' => [
                                            'confirm' => '你确定要执行吗？',
                                        ],]
                            ) ?>
                        </td>
                    </tr>
                     <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right tooltip-demo">
               <?= LinkPager::widget([
                  'pagination' => $pagination,
                  'firstPageLabel'=>"First",
                  'prevPageLabel'=>'Prev',
                  'nextPageLabel'=>'Next',
                  'lastPageLabel'=>'Last',
               ]) ?>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
