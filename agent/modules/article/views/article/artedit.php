<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '文章修改']);
$this->registerMetaTag(['name' => 'description', 'content' => '文章修改'], 'description');
$this->title= '代理系统-文章修改';
$this->params['breadcrumbs'][] = '文章管理';
$this->params['breadcrumbs'][] = '文章修改';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
        <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>文章修改</h5>
	        </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-9 m-b-xs tooltip-demo">
                        <a href="<?=Url::toRoute(['articlelist']) ?>" data-toggle="modal"> 
                            <span data-toggle="tooltip" data-placement="top" title="文章列表" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> 返回文章列表</span>
                        </a>
                    </div>
                </div>
               <?php
                $form = ActiveForm::begin([
                    'action' => ['artedit'],
                    'id' => 'artadd-form',
                    'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
                ]) ?>
                    <input type="hidden" name="id" value=<?=$id;?> />
                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章分类</label>
                        <div class="col-lg-2">
                           <?= $form->field($model, 'cid',[
                            'options'=>['class'=>'']])->dropDownList(ArrayHelper::map($cate,'id', 'cname'),[
                            'prompt' => '--选择所属行业--',
                        ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章标题</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'title', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '文章标题','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章封面</label>
                        <div class="col-lg-2">
                           <?= $form->field($model, 'cover', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control'],
                                ])->fileInput()->label(false); ?>
                        </div><img src="<?= $model->cover;?>" class="img-circle" width="30" />
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章描述</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'desc', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '255个字内','class' => 'form-control'],
                                ])->textarea(['rows'=>4])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章内容</label>
                        <div class="col-lg-7">
                            <?= $form->field($model, 'content')->widget('macle\ueditor\Ueditor',['id'=>'Article[content]','ucontent'=>$model->content])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>             
               
            </div>

        </div>
        </div>
	</div>
</div>