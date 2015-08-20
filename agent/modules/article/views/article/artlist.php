<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '文章列表']);
$this->registerMetaTag(['name' => 'description', 'content' => '文章列表'], 'description');
$this->title= '代理系统-文章列表';
$this->params['breadcrumbs'][] = '文章管理';
$this->params['breadcrumbs'][] = '文章列表';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>文章列表</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                    <a href="<?=Url::toRoute(['artadd']) ?>" data-toggle="modal"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加文章" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加文章</span>
                    </a>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search"> 
                        <span class="input-group-btn"><button class="btn btn-sm btn-primary" type="button"> Go!</button> </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>文章分类</th>
                        <th>封面图</th>
                        <th>发布日期</th>
                        <th>更新日期</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($model)){ 
                            foreach ($model as $_v) {
                    ?>
                    <tr>
                        <td><?= $_v->id?></td>
                        <td><?= $_v->title?></td>
                        <td><?= $_v->cate->cname?></td>
                        <td><img src="<?= $_v->cover;?>" class="img-circle" width="30" /></td>
                        <td><?= date('Y年m月d日',$_v->created_at);?></td>
                        <td><?= date('Y年m月d日',$_v->updated_at);?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            ['artedit', 'id' => $_v->id], 
                                            ['class' => 'btn btn-default btn-xs',
                            ]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                            ['artdel', 'id' => $_v->id], 
                                            ['class' => 'btn btn-default btn-xs',
                                            'data' => [
                                                'confirm' => '你确定要删除文章吗？',
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
