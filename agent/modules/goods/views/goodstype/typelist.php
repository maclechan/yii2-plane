<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商品类型']);
$this->registerMetaTag(['name' => 'description', 'content' => '商品类型'], 'description');
$this->title= '代理系统-商品类型';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '商品类型';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品类型</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                    <a data-toggle="modal" data-target="#type"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加商品类型" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加商品类型</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品类型名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($type)){ 
                            foreach ($type as $_v) {              
                    ?>
                    <tr>
                        <td><?= $_v->type_id?></td>
                        <td><?= $_v->type_name?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-sort-alpha-asc"></i> 属性列表', 
                                            ['attrlist', 'type_id' =>  $_v->type_id], 
                                            ['class' => 'btn btn-default btn-xs',
                            ]) ?>
                            <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            'javascript:void(0);',
                                            ['class' => 'btn btn-default btn-xs',
                                            'data' => [
                                                'toggle' => 'modal', //赋加相当于 data-toggle="modal"
                                                'target' => '#typedit',
                                                'id' => "$_v->type_id",
                                                'type_name' => "$_v->type_name",
                                            ],
                            ]) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                        ['typedel', 'id' =>  $_v->type_id], 
                                        ['class' => 'btn btn-default btn-xs',
                                        'data' => [
                                            'confirm' => '删除商品类型将会清除该类型下的所有属性。您确定要删除选定的商品类型吗？',
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
<!--模态框->添加行业分类-->
<div class="modal inmodal fade" id="type" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">添加商品类型</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['typeadd'],
                'id' => 'cateadd-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group">
                    <label class="col-lg-4 control-label">商品类型名称</label>
                    <div class="col-lg-4">
                       <?= $form->field($model, 'type_name', [
                            'options'=>['class'=>''],
                            'inputOptions' => ['placeholder' => '请输入类别名称','class' => 'form-control'],
                            ])->label(false); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<?php
//验证不能为空
$this->registerJs(
   '$("document").ready(function(){ 
        $("#cateadd-form").validate({
            errorElement : "small", 
            errorClass : "error",
        });
    });'
);
?>
<!---->
<!--模态框->类别编辑-->
<div class="modal inmodal fade" id="typedit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">修改商品类型</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['typedit'],
                'id' => 'typedit-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group">
                    <label class="col-lg-4 control-label">商品类型名称</label>
                    <div class="col-lg-4">
                        <input type="hidden" class="form-control" id="id" name="id">
                       <?= $form->field($model, 'type_name', [
                            'options'=>['class'=>''],
                            'inputOptions' => ['placeholder' => '请输入类别名称','class' => 'form-control','id'=>'type_name'],
                            ])->label(false); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                <?= Html::submitButton('编辑', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>

        </div>
    </div>
</div>
<?php
//赋值到编辑框
$this->registerJs(
   '$("document").ready(function(){ 
        $("#typedit").on("show.bs.modal", function (event) {
        //得到标签定义的值
          var typedit = $(event.relatedTarget) 
          var id = typedit.data("id")
          var type_name = typedit.data("type_name")
        //把值赋到各自input中
          var modal = $(this)
          modal.find(".modal-body #id").val(id)
          modal.find(".modal-body #type_name").val(type_name)
        });
    });'
);
?>
<!--edit-->