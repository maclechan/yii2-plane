<?php
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商户管理']);
$this->registerMetaTag(['name' => 'description', 'content' => '商户管理'], 'description');
$this->title= '代理系统-商家管理';
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
	            <h5>商户列表</h5>
	            <?php 
                 if(Yii::$app->getSession()->hasFlash('info')){
                      echo '<p class="label label-primary sflash">'.Yii::$app->getSession()->getFlash('info').'</p>';
                  }  
              ?> 

	        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs tooltip-demo">
                	<a href="<?=Url::toRoute(['merchadd']) ?>" data-toggle="modal"> 
                		<span data-toggle="tooltip" title="商家入驻" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</span>
                	</a>
                    <?php 
                    use kartik\export\ExportMenu;

                        $gridColumns = [
                            'id',
                            'username',
                            'email',
                            'legalname',
                            'phone',
                            'compname',
                        ];
                    echo ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns,
                            'fontAwesome' => true,
                            'columnSelectorOptions'=>[
                                'class'=> ' btn btn-sm btn-primary',
                            ],
                            'dropdownOptions' => [
                                'icon'=>'<i class="glyphicon glyphicon-export"></i>',
                                'label' => '导出',
                                'class' => 'btn btn-sm btn-primary'
                            ],
                            'exportConfig' => [//禁止PDF TEXT格式导出
                                ExportMenu::FORMAT_TEXT => false,
                                ExportMenu::FORMAT_PDF => false
                            ]
                        ]);          
                    ?>
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
                        <th>所属行业</th>
                        <th>企业名称</th>
                        <th>商家法人</th>
                        <th>登陆账号</th>
                        <th>手机</th>
                        <th>状态 </th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($merch)){ 
                            foreach ($merch as $_v) {
                    ?>
                    <tr>
                        <td><?= $_v->id?></td>
                        <td><?= $_v->cateid?></td>
                        <td><?= $_v->compname?></td>
                        <td><?= $_v->legalname?></td>
                        <td><?= $_v->username?></td>
                        <td><?= $_v->phone?></td>
                        <td><?= $_v->status==1 ? '己开启' : '己关闭'; ?></td>
                        <td>
							<?= Html::a('<i class="fa fa-file"></i> 编辑', 
                                            'javascript:void(0);',
                                            ['class' => 'btn btn-default btn-xs',
                                              'data' => [
                                                'toggle' => 'modal', //赋加相当于 data-toggle="modal"
                                                'target' => '#catedit',
                                                'id' => "$_v->id",
                                                //'name' => "$_v->name",
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