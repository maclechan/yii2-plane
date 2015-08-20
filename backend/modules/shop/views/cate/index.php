<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '行业类别']);
$this->registerMetaTag(['name' => 'description', 'content' => '商家所属行业分类'], 'description');
$this->title= '代理系统-行业分类';
$this->params['breadcrumbs'][] = '商家管理';
$this->params['breadcrumbs'][] = '商家中心';
$this->params['breadcrumbs'][] = '行业类别';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
        <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>行业类别</h5>
	            <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
	        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                	<a href="" data-toggle="modal" data-target="#mcate"> 
                		<span data-toggle="tooltip" data-placement="top" title="添加类别" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</span>
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
                        <th>类别名称 </th>
                        <th>状态 </th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($cate)){ 
                            foreach ($cate as $_v) {
                    ?>
                    <tr>
                        <td><?= $_v->id?></td>
                        <td><?= $_v->name?></td>
                        <td><?= $_v->status==1 ? '己开启' : '己关闭'; ?></td>
                        <td>
							<?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            'javascript:void(0);',
                                            ['class' => 'btn btn-default btn-xs',
                                              'data' => [
                                                'toggle' => 'modal', //赋加相当于 data-toggle="modal"
                                                'target' => '#catedit',
                                                'id' => "$_v->id",
                                                'name' => "$_v->name",
                                                ],
                                ]) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                            ['index'/*, 'id' => $_v->id*/], 
                                            ['class' => 'btn btn-default btn-xs',
                                            'data' => [
                                                'confirm' => '请先删除该分类下面所有商家！',
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
<div class="modal inmodal fade" id="mcate" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">增加类别</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['cateadd'],
                'id' => 'cateadd-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
            	<div class="form-group">
                	<label class="col-lg-4 control-label">类别名称</label>
                    <div class="col-lg-4">
                       <?= $form->field($model, 'name', [
                       		'options'=>['class'=>''],
                       		'inputOptions' => ['placeholder' => '请输入类别名称','class' => 'form-control'],
                       		])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">状态</label>
                    <div class="col-lg-4">
                       <?= $form->field($model, 'status', [
                       		'options'=>['class'=>''],
                       		])->radioList(['1'=>'开启','0'=>'关闭'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold']]])->label(false); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <?= Html::submitButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
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
<div class="modal inmodal fade" id="catedit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">修改类别</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['catedit'],
                'id' => 'catedit-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
            	<div class="form-group">
                	<label class="col-lg-4 control-label">类别名称</label>
                    <div class="col-lg-4">
                    	<input type="hidden" class="form-control" id="id" name="id">
                       <?= $form->field($model, 'name', [
                       		'options'=>['class'=>''],
                       		'inputOptions' => ['placeholder' => '请输入类别名称','class' => 'form-control'],
                       		])->label(false); ?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">状态</label>
                    <div class="col-lg-4">
                       <?= $form->field($model, 'status', [
                       		'options'=>['class'=>''],
                       		])->radioList(['1'=>'开启','0'=>'关闭'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold']]])->label(false); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <?= Html::submitButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
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
        $("#catedit").on("show.bs.modal", function (event) {
        //得到标签定义的值
          var catedit = $(event.relatedTarget) 
          var id = catedit.data("id")
          var name = catedit.data("name")
        //把值赋到各自input中
          var modal = $(this)
          modal.find(".modal-body #id").val(id)
          modal.find(".modal-body #agmcate-name").val(name)
        });
    });'
);
?>
<!--edit-->