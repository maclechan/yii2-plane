<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商户管理']);
$this->registerMetaTag(['name' => 'description', 'content' => '商户入驻'], 'description');
$this->title= '代理系统-商家入驻';
$this->params['breadcrumbs'][] = '商家管理';
$this->params['breadcrumbs'][] = '商家中心';
$this->params['breadcrumbs'][] = '商户管理';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
        <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>添加商家</h5>
	        </div>

            <div class="ibox-content">
               <?php
                $form = ActiveForm::begin([
                    'action' => ['merchadd'],
                    'id' => 'merchadd-form',
                    'options' => ['class' => 'form-horizontal'],
                ]) ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">所属行业</label>
                        <div class="col-lg-2">
                           <?= $form->field($model, 'cateid',[
                            'options'=>['class'=>'']])->dropDownList(ArrayHelper::map($mcate,'id', 'name'),[
                            'prompt' => '--选择所属行业--',
                        ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">登陆帐号</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'username', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写商家登陆帐号','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">登陆密码</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'password_hash',[
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写商家登陆密码','class' => 'form-control'],
                                ])->passwordInput()->label(false); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">企业名称</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'compname', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写企业全称','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">企业法人</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'legalname', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写企业真实法人姓名','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">手机号码</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'phone', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写企业全称','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮箱</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'email', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '请填写邮箱','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= Html::submitButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>  
            </div>

        </div>
        </div>
	</div>
</div>