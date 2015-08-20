<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商品属性']);
$this->registerMetaTag(['name' => 'description', 'content' => '商品属性'], 'description');
$this->title= '代理系统-商品属性';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '商品属性';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品属性</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                    <a href="<?=Url::toRoute(['attradd','type_id'=>$type_id]) ?>" data-toggle="modal"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加商品属性" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加商品属性</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>属性名称</th>
                        <th>商品类型</th>
                        <th>属性值的录入方式</th>
                        <th>可选值列表</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($attr)){ 
                            foreach ($attr as $_v) {              
                    ?>
                    <tr>
                        <td><?= $_v->attr_id?></td>
                        <td><?= $_v->attr_name?></td>
                        <td><?= $_v->type->type_name?></td>
                        <td>
                            <?php
                                $atype = $_v->attr_input_type;
                                if($atype==0){
                                    echo '手工录入';
                                }elseif ($atype==1) {
                                    echo '从列表中选择';
                                }elseif ($atype==2) {
                                    echo '多行文本框';
                                }
                            ?>
                        </td>
                        <td><?= $_v->attr_value?></td>
                        <td><?= $_v->sort_order?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            ['attredit', 'id' =>  $_v->attr_id,'type_id' => $_v->type_id], 
                                            ['class' => 'btn btn-default btn-xs',
                            ]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                        ['attrdel', 'id' =>  $_v->attr_id,'type_id' => $_v->type_id], 
                                        ['class' => 'btn btn-default btn-xs',
                                        'data' => [
                                            'confirm' => '您确定要删除选定的商品属性吗？',
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