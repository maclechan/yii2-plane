<?php
use agent\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '添加商品']);
$this->registerMetaTag(['name' => 'description', 'content' => '添加商品'], 'description');
$this->title= '代理系统-添加商品';
$this->params['breadcrumbs'][] = '商品管理';
$this->params['breadcrumbs'][] = '添加商品';
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
                    <a href="<?=Url::toRoute(['goodslist']) ?>" data-toggle="modal"> 
                        <span data-toggle="tooltip" data-placement="top" title="商品列表" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> 返回商品列表</span>
                    </a>
                </div>
            </div>

            <div class="row m-t-sm">
                 <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">通用信息</a></li>
                                    <li class=""><a href="#tab-2" data-toggle="tab">详细描述</a></li>
                                    <li class=""><a href="#tab-3" data-toggle="tab">其他信息</a></li>
                                    <li class=""><a href="#tab-4" data-toggle="tab">商品属性</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                            $form = ActiveForm::begin([
                                'action' => ['goodsave'],
                                'id' => 'goodsave-form',
                                'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
                            ]) ?>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">商品名称</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'goods_name', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                                    ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">商品分类</label>
                                            <div class="col-lg-3">
                                                <select name="Goods[cat_id]" class="form-control">
                                                    <option>--请选择--</option>
                                                    <?php foreach($cate as $_v){ ?>
                                                    <option value="<?php echo $_v['cat_id'];?>">
                                                        <?php echo str_repeat('&nbsp;&nbsp;',$_v['level'])?>
                                                        <?php echo $_v['cat_name'];?>
                                                    </option>
                                                    <?php };?>      
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">商品品牌</label>
                                            <div class="col-lg-3">
                                                <?= $form->field($model, 'brand_id',[
                                                'options'=>['class'=>'']])->dropDownList(ArrayHelper::map($brand,'id', 'name'),[
                                                'prompt' => '--请选择--',
                                            ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">商品货号</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'goods_sn', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['placeholder' => '商品货号','class' => 'form-control'],
                                                    ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">市场售价</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'market_price', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['placeholder' => '市场售价','class' => 'form-control'],
                                                    ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">本店售价</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'shop_price', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['placeholder' => '本店售价','class' => 'form-control'],
                                                    ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">促销价</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'promote_price', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['placeholder' => '促销价','class' => 'form-control'],
                                                    ])->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">促销日期</label>
                                            <div class="col-lg-1">
                                               <?= $form->field($model, 'promote_start_time', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['class' => 'form-control'],
                                                    ])->label(false); ?>
                                                </div>
                                                <div class="col-lg-1">
                                                <?= $form->field($model, 'promote_end_time', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['class' => 'form-control'],
                                                    ])->label(false); ?>    
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">商品图片</label>
                                            <div class="col-lg-3">
                                               <?= $form->field($model, 'goods_img', [
                                                    'options'=>['class'=>''],
                                                    'inputOptions' => ['class' => 'form-control'],
                                                    ])->fileInput()->label(false); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-4">
                                                <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                                                <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="tab-2">
                                   <div class="form-group">
                                        <label class="col-lg-1 control-label"></label>
                                        <div class="col-lg-8">
                                            <?= $form->field($model, 'goods_content')->widget('macle\ueditor\Ueditor',['id'=>'Goods[goods_content]'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-4">
                                                <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                                                <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="tab-3">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">商品库存数量</label>
                                        <div class="col-lg-3">
                                           <?= $form->field($model, 'goods_number', [
                                                'options'=>['class'=>''],
                                                'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                                ])->label(false); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">库存警告数量</label>
                                        <div class="col-lg-3">
                                           <?= $form->field($model, 'warn_number', [
                                                'options'=>['class'=>''],
                                                'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                                ])->label(false); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">加入推荐</label>
                                        <div class="col-lg-3">
                                            <label class="input_radio dbold"><input type="checkbox" value="1" name="Goods[is_best]"> 精品</label>
                                            <label class="input_radio dbold"><input type="checkbox" value="1" name="Goods[is_new]"> 新品</label>
                                            <label class="input_radio dbold"><input type="checkbox" value="1" name="Goods[is_hot]"> 热卖</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">上架</label>
                                        <div class="col-lg-3">
                                            <label class="input_radio dbold"><input type="checkbox" value="1" name="Goods[is_onsale]"> 打勾表示允许销售，否则不允许销售</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">是否为免运费商品</label>
                                        <div class="col-lg-3">
                                            <label class="input_radio dbold"><input type="checkbox" value="1" name="Goods[is_shipping]">  打勾表示此商品不会产生运费花销，否则按照正常运费计算</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">商品关键词</label>
                                        <div class="col-lg-3">
                                           <?= $form->field($model, 'keywords', [
                                                'options'=>['class'=>''],
                                                'inputOptions' => ['placeholder' => '分类名称','class' => 'form-control'],
                                                ])->label(false); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">商品简单描述</label>
                                        <div class="col-lg-3">
                                            <?= $form->field($model, 'goods_desc', [
                                                'options'=>['class'=>''],
                                                'inputOptions' => ['placeholder' => '255个字内','class' => 'form-control'],
                                                ])->textarea(['rows'=>4])->label(false); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">商家备注</label>
                                        <div class="col-lg-3">
                                            <?= $form->field($model, 'seller_note', [
                                                'options'=>['class'=>''],
                                                'inputOptions' => ['placeholder' => '255个字内','class' => 'form-control'],
                                                ])->textarea(['rows'=>4])->label(false); ?>
                                            <span class="vertical-date"><i class="fa fa-volume-up"></i> <small>仅供商家自己看的信息.</small> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                                            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-4">

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">所属商品类型</label>
                                            <div class="col-lg-3">
                                                <?= $form->field($model, 'type_id',[
                                                'options'=>['class'=>'']])->dropDownList(ArrayHelper::map($type,'type_id', 'type_name'),[
                                                'prompt' => '--请选择商品类型--',
                                            ])->label(false); ?>
                                            <span class="vertical-date"><i class="fa fa-quote-left"></i> <small>请选择商品的所属类型，进而完善此商品的属性.</small> <i class="fa fa-quote-right"></i></span>
                                            </div>
                                        </div>

                                        <div id="attrTable"> </div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-4">
                                                <?= Html::resetButton('取消', ['class' => 'btn btn-default',"data-dismiss"=>"modal"]) ?>
                                                <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </div>
                                       
                                </div>

                            </div>

                         </div><?php ActiveForm::end() ?> 

                    </div>
                  </div>
            </div>

        </div>
        </div>
        </div>
    </div>
</div>
<?php
//ajax动态获取商品属性
$this->registerJs(
   '$("document").ready(function(){ 
       $("#goods-type_id").change(function(){
            var type_id = $("#goods-type_id option:selected").val();
            //alert(type_id);
            if(!type_id){
                $("#attrTable").html("");
            }
            //Yii有个JS全局 的yii对象 
            var _csrf = yii.getCsrfToken();
            if(type_id){
                $.ajax({
                    type: "POST",
                    url: "index.php?r=goods/goods/ajaxattr",
                    data: {"type_id":type_id,"_csrf":_csrf},
                    //dataType:"json",
                    success:function(data){
                        if(data){
                            $("#attrTable").html(data);
                        }else{
                            alert("读取失败");
                        }
                    }
                });     
            }
        });
    });'
);
?>
