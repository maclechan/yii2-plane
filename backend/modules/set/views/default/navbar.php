<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title= '代理系统-系统菜单';
$this->params['breadcrumbs'][] = '系统设置';
$this->params['breadcrumbs'][] = '菜单管理';
$this->params['breadcrumbs'][] = '系统菜单';
AppAsset::register($this);
AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js');
?>
<div class="wrapper wrapper-content">
        <div class="row">
            <!--左侧小导航栏-->
            <?= $this->render('_leftnav') ?>
            
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                <!--add menu-->
                    <a href="" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#Modobar"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加二级菜单"><i class="fa fa-plus"></i> 添加</span>
                    </a>

                </div>
                <h2>二级菜单 </h2>    
                  <?php 
                     if(Yii::$app->getSession()->hasFlash('info')){
                          echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                      }  
                  ?> 
            </div>
            <div class="mail-box">

                <div class="mail-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>模块ID</th>
                            <th>模块命名</th>
                            <th>一级菜单</th>
                            <th>二级菜单</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($navbar)){ 
                                foreach ($navbar as $_v) {
                        ?>
                        <tr>
                            <td><?= $_v->id; ?></td>
                            <td><?= $_v->nid?></td>
                            <td><?= $_v->nav->nav_en?></td>
                            <td><?= $_v->nav->nav_cn?></td>
                            <td><?= $_v->navbar_cn; ?></td>
                            <td><?= $_v->status==1 ? '己开启' : '己隐藏'; ?></td>
                            <td>
                                <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            'javascript:void(0);',
                                            ['class' => 'btn btn-default btn-xs',
                                              'data' => [
                                                'toggle' => 'modal', //赋加相当于 data-toggle="modal"
                                                'target' => '#Nbaredit',
                                                'id' => "$_v->id",
                                                'nid' => "{$_v->nav->id}",
                                                'cn' => "$_v->navbar_cn",],
                                ]) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                            ['navbardel', 'id' => $_v->id], 
                                            ['class' => 'btn btn-default btn-xs',
                                            'data' => [
                                                'confirm' => '你确定要执行该操作吗? 此导航下面的所有子导航也将全部删除！',
                                            ],]
                                ) ?>
                            </td>
                        </tr>
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>

                    <div class="mail-body text-right tooltip-demo">
                       <?= LinkPager::widget([
                          'pagination' => $pagination,
                          'firstPageLabel'=>"First",
                          'prevPageLabel'=>'Prev',
                          'nextPageLabel'=>'Next',
                          'lastPageLabel'=>'Last',
                       ]) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
        </div>

<!--模态框->添加菜单-->
<div class="modal inmodal fade" id="Modobar" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <span class="font-bold">添加菜单</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['navbaradd'],
                'id' => 'addbar-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group"><label class="col-lg-4 control-label">一级菜单</label>
                    <div class="col-lg-4">
                        <?= Html::dropDownList('AgNavbar[nid]', null, ArrayHelper::map($nav, 'id', "nav_cn"),['class' => 'form-control m-b','required'=>"" ,'prompt' => '--请选择一级菜单--']) ?>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-4 control-label">二级菜单</label>
                    <div class="col-lg-4">
                        <?= Html::input('text', "AgNavbar[navbar_cn]", '', ['class' => 'form-control' , 'placeholder'=>"菜单名称", 'required'=>""]) ?>
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
        $("#addbar-form").validate({
            errorElement : "small", 
            errorClass : "error",
        });
    });'
);
?>
<!---->
<!--模态框->菜单编辑-->
<div class="modal inmodal fade" id="Nbaredit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">编辑菜单</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['baredit'],
                'id' => 'editbar-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group"><label class="col-lg-4 control-label">一级菜单</label>
                    <div class="col-lg-4">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <?= Html::dropDownList('AgNavbar[nid]', null, ArrayHelper::map($nav, 'id', "nav_cn"),['class' => 'form-control m-b','id'=>'bar_nid','required'=>""]) ?>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-4 control-label">二级菜单</label>
                    <div class="col-lg-4">
                        <?= Html::input('text', "AgNavbar[navbar_cn]", '', ['class' => 'form-control' , 'id'=>'bar_cn', 'placeholder'=>"菜单名称", 'required'=>""]) ?>
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
        $("#Nbaredit").on("show.bs.modal", function (event) {
        //得到标签定义的值
          var editbar = $(event.relatedTarget) 
          var id = editbar.data("id")
          var nid = editbar.data("nid")
          var cn = editbar.data("cn")
        //把值赋到各自input中
          var modal = $(this)
          modal.find(".modal-body #id").val(id)
         //下拉框默认选中传入的值
          modal.find(".modal-body #bar_nid option[value="+nid+"]").attr("selected","nid")
          modal.find(".modal-body #bar_cn").val(cn)
        });
    });'
);
?>
<!--edit-->