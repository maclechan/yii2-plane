<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title= '代理系统-商家菜单';
$this->params['breadcrumbs'][] = '系统设置';
$this->params['breadcrumbs'][] = '菜单管理';
$this->params['breadcrumbs'][] = '商家菜单';
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
                    <a href="" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModa"> 
                        <span data-toggle="tooltip" data-placement="top" title="添加一级菜单"><i class="fa fa-plus"></i> 添加</span>
                    </a>

                </div>
                <h2>一级菜单 </h2>    
                  <?php 
                     if(Yii::$app->getSession()->hasFlash('info')){
                          echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</>';
                      }  
                  ?> 
            </div>
            <div class="mail-box">

                <div class="mail-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>模块ID</th>
                            <th>模块命名</th>
                            <th>一级菜单</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(isset($nav)){ 
                                foreach ($nav as $_v) {
                        ?>
                        <tr>
                            <td><?= $_v->id; ?></td>
                            <td><?= $_v->nav_en; ?></td>
                            <td><?= $_v->nav_cn; ?></td>
                            <td><?= $_v->status==1 ? '己开启' : '己隐藏'; ?></td>
                            <td>
                                <?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            'javascript:void(0);',
                                            ['class' => 'btn btn-default btn-xs',
                                              'data' => [
                                                'toggle' => 'modal', //赋加相当于 data-toggle="modal"
                                                'target' => '#navedit',
                                                'id' => "$_v->id",
                                                'cn' => "$_v->nav_cn",
                                                'en' => "$_v->nav_en", ],
                                ]) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-trash"></i> 删除', 
                                            ['navdel', 'id' => $_v->id], 
                                            ['class' => 'btn btn-default btn-xs',
                                            'data' => [
                                                'confirm' => '你确定要执行该操作吗? 此导航下面的所有子导航也将全部删除！',
                                                //'id' => 'get',   赋加相当于 data-id="get"
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
<div class="modal inmodal fade" id="myModa" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">添加菜单</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['navadd'],
                'id' => 'addnav-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group"><label class="col-lg-4 control-label">菜单名</label>
                    <div class="col-lg-4">
                        <input type="text" name="AgMnav[nav_cn]" required class="form-control" id="AgMnav-nav_cn" placeholder="一级菜单对应模块名称">
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-4 control-label">模块名</label>
                    <div class="col-lg-4">
                        <input type="text" name="AgMnav[nav_en]" required="" class="form-control" id="AgMnav-nav_en" placeholder="请填给模块取个英文名">
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
        $("#addnav-form").validate({
            errorElement : "small", 
            errorClass : "error",
        });
    });'
);
?>
<!---->

<!--模态框->菜单编辑-->
<div class="modal inmodal fade" id="navedit" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                <span class="font-bold">编辑菜单</span>
            </div>
            <div class="modal-body">
           <?php
            $form = ActiveForm::begin([
                'action' => ['navedit'],
                'id' => 'editnav-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
                <div class="form-group"><label class="col-lg-4 control-label">菜单名</label>
                    <div class="col-lg-4">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="text" name="AgMnav[nav_cn]" required="" class="form-control" id="nav_cn" placeholder="一级菜单对应模块名">
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-4 control-label">模块名</label>
                    <div class="col-lg-4">
                        <input type="text" name="AgMnav[nav_en]" required="" class="form-control" id="nav_en" placeholder="请填给模块取个英文名">
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
        $("#navedit").on("show.bs.modal", function (event) {
        //得到标签定义的值
          var editnav = $(event.relatedTarget) 
          var id = editnav.data("id")
          var cn = editnav.data("cn")
          var en = editnav.data("en")
        //把值赋到各自input中
          var modal = $(this)
          modal.find(".modal-body #id").val(id)
          modal.find(".modal-body #nav_cn").val(cn)
          modal.find(".modal-body #nav_en").val(en)
        });
    });'
);
?>
<!--edit-->
