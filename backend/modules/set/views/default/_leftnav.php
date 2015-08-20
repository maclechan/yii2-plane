<?php 
use yii\helpers\Url;
 ?>
<div class="col-lg-2">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="file-manager">
                <h5>Menu List</h5>
                <ul class="folder-list m-b-md" style="padding: 0">
                    <li><a href="<?= Url::toRoute(['index']); ?>"> <i class="fa fa-bars"></i> 一级菜单</a></li>
                    <li><a href="<?= Url::toRoute(['navbar']); ?>"> <i class="fa fa-bars"></i> 二级菜单</a></li>
                    <li><a href="<?= Url::toRoute(['navitem']); ?>"> <i class="fa fa-bars"></i> 三级菜单</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>