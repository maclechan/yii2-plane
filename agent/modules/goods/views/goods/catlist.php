<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商品类别']);
$this->registerMetaTag(['name' => 'description', 'content' => '商品类别'], 'description');
$this->title= '代理系统-商品类别';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '添加分类';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品分类</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                    <a href="<?=Url::toRoute(['catadd']) ?>" data-toggle="modal"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加分类" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加分类</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>分类名称</th>
                        <th>商品数量</th>
                        <th>导航栏</th>
                        <th>是否显示</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($cate)){ 
                            foreach ($cate as $_v) {              
                    ?>
                    <tr>
                        <td><?= str_repeat("<i class='bule-1 fa fa-level-up'> </i> ", $_v['level'])?><?= $_v['cat_name']?></td>
                        <td>暂定</td>
                        <td><?= $_v['show_in_nav']==1 ? '<i class="bule-1 fa fa-check"></i>':'<i class="red-1 fa fa-times"></i>' ?></td>
                        <td><?= $_v['is_show']==1 ? '<i class="bule-1 fa fa-check"></i>':'<i class="red-1 fa fa-times"></i>' ?></td>
                        <td><?= $_v['sort_order'] ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            ['catedit', 'id' =>  $_v['cat_id']], 
                                            ['class' => 'btn btn-default btn-xs',
                            ]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                        ['catedel', 'id' => $_v['cat_id']], 
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

        </div>
        </div>
        </div>
    </div>
</div>
