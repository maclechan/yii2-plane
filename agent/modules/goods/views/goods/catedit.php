<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商品类别修改']);
$this->registerMetaTag(['name' => 'description', 'content' => '商品类别修改'], 'description');
$this->title= '代理系统-商品类别修改';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '修改分类';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); 
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改分类</h5>
                <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 
            </div>

            <div class="ibox-content">
                 <div class="row">
                    <div class="col-sm-9 m-b-xs tooltip-demo">
                        <a href="<?=Url::toRoute(['catlist']) ?>" data-toggle="modal"> 
                            <span data-toggle="tooltip" data-placement="top" title="商品分类列表" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> 返回商品分类列表</span>
                        </a>
                    </div>
                </div> 
                <?php
                $form = ActiveForm::begin([
                    'action' => ['catedit'],
                    'id' => 'artadd-form',
                    'options' => ['class' => 'form-horizontal'],
                ]) ?>
                    <input type="hidden" name="id" value=<?=$cat_id;?> />
                    <div class="form-group">
                        <label class="col-lg-2 control-label">上级分类</label>
                        <div class="col-lg-2">
                            <select name="GoodsCategory[parent_id]" class="form-control" id="goodscategory-parent_id">
                                <option value="0">顶级分类</option>
                                <?php foreach($cate as $_v){ ?>
                                <option value="<?php echo $_v['cat_id'];?>" <?php echo $model['parent_id'] == $_v['cat_id'] ? 'selected' : '';?>>
                                    <?php echo str_repeat('&nbsp;&nbsp;',$_v['level'])?>
                                    <?php echo $_v['cat_name'];?>
                                </option>
                                <?php };?>      
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">分类名称</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'cat_name', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">排序</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'sort_order', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
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
                        <label class="col-lg-2 control-label">是否显示在导航栏</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'show_in_nav', [
                           'inputOptions' => ['placeholder' => $model->show_in_nav=0],
                            'options'=>['class'=>''],
                            ])->radioList(['1'=>'是','0'=>'否'],['itemOptions' => ['labelOptions'=>['class'=>'input_radio dbold']]])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">关键字</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'keywords', [
                                'options'=>['class'=>''],
                                'inputOptions' => ['class' => 'form-control'],
                                ])->label(false); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">文章描述</label>
                        <div class="col-lg-3">
                           <?= $form->field($model, 'cat_desc', [
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