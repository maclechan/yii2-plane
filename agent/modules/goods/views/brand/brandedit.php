<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '修改品牌']);
$this->registerMetaTag(['name' => 'description', 'content' => '修改品牌'], 'description');
$this->title= '代理系统-修改品牌';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '修改品牌';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改品牌</h5>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-9 m-b-xs tooltip-demo">
                        <a href="<?=Url::toRoute(['brandlist']) ?>" data-toggle="modal"> 
                            <span data-toggle="tooltip" data-placement="top" title="品牌列表" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> 返回品牌列表</span>
                        </a>
                    </div>
                </div>
               <?php
                $form = ActiveForm::begin([
                    'action' => ['brandedit'],
                    'id' => 'artadd-form',
                    'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
                ]) ?>
                    <input type="hidden" name="id" value=<?=$id;?> />
                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌名称</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'name', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌网址</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'url', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '品牌网址','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌LOGO</label>
                        <div class="col-lg-2">
                           <?= $form->field($model, 'logo', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control'],
                                ])->fileInput()->label(false); ?>
                        </div><img src="<?= $model->logo;?>" class="img-circle" width="30" />
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">是否显示</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'is_show', [
                            'inputOptions' => ['placeholder' => $model->is_show=1],
                            'options'=>['class'=>''],
                            ])->radioList(['1'=>'是','0'=>'否'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold']]])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">排序</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'sort', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌描述</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'desc', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '255个字内','class' => 'form-control'],
                                ])->textarea(['rows'=>4])->label(false); ?>
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