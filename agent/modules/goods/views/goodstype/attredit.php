<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '添加属性']);
$this->registerMetaTag(['name' => 'description', 'content' => '添加属性'], 'description');
$this->title= '代理系统-添加属性';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '编辑商品属性';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>编辑商品属性</h5>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-9 m-b-xs tooltip-demo">
                        <a href="<?=Url::toRoute(['attrlist','type_id'=>$type_id]) ?>" data-toggle="modal"> 
                            <span data-toggle="tooltip" data-placement="top" title="属性列表" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> 返回属性列表</span>
                        </a>
                    </div>
                </div>
               <?php
                $form = ActiveForm::begin([
                    'action' => ['attredit'],
                    'id' => 'artadd-form',
                    'options' => ['class' => 'form-horizontal'],
                ]) ?>
                <input type="hidden" name="id" value=<?=$id;?> />
                    <div class="form-group">
                        <label class="col-lg-2 control-label">所属商品类型</label>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'type_id',[
                            'options'=>['class'=>'']])->dropDownList(ArrayHelper::map($type,'type_id', 'type_name'),[
                            'prompt' => '--请选择--',
                        ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">属性名称</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'attr_name', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '属性名称','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">属性是否可选</label>
                        <div class="col-lg-5">
                           <?= $form->field($model, 'attr_type', [
                            'inputOptions' => ['placeholder' => $model->attr_type=0],
                            'options'=>['class'=>''],
                            ])->radioList(['0'=>'唯一属性','1'=>'单选属性','2'=>'复选属性'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold']]])->label(false); ?>
                            <span class="vertical-date"><i class="fa fa-quote-left"></i> <small>选择"单选/复选属性"时，可以对商品该属性设置多个值，同时还能对不同属性值指定不同的价格加价，用户购买商品时需要选定具体的属性值。选择"唯一属性"时，商品的该属性值只能设置一个值，用户只能查看该值。</small> <i class="fa fa-quote-right"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">该属性值的录入方式</label>
                        <div class="col-lg-4">
                           <?= $form->field($model, 'attr_input_type', [
                           'inputOptions' => ['placeholder' => $model->attr_input_type=0],
                            'options'=>['class'=>''],
                            ])->radioList(['0'=>'手工录入','1'=>'从下面的列表中选择（一行代表一个可选值）','2'=>'多行文本框'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold'],'class'=>"macle"]])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">可选值列表</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'attr_value', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control','disabled'=>'disabled'],
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
<?php
//击类型按钮时切换选项的禁用状态
$this->registerJs(
   '$("document").ready(function(){
        $(".macle").click(function(){
            var attr_input_type = $("#attribute-attr_input_type label input:checked").val();
            if(attr_input_type == 1){
                $("#attribute-attr_value").removeAttr("disabled");
            }else{
                $("#attribute-attr_value").attr({disabled:"disabled"}); 
            }
        })
    });'
);
?>