<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <div class="logo-element">
                        A+
                    </div>
                <?php 
                    if(isset($nav)){ 

                        foreach ($nav as $_v) {
                ?>  
                <li class="active">
                    
                    <a><i class="fa fa-bars"></i> <span class="nav-label"><?= $_v['nav_cn']?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php 
                            foreach ($_v->mbar as $bar) {
                         ?>
                        <li class="active"><?= Html::a('<i class="fa fa-caret-right"></i>'.$bar['act_cn'], ["/$_v[nav_en]/$bar[cont]/$bar[act_en]"]) ?></li>
                        <?php } ?>
                    </ul>
                </li>

                <?php }}else{ ?>
                <li>
                    <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">未定义</span> <span class="label label-primary pull-right">NEW</span></a>
                </li>
                <?php } ?>
               
            </ul>

        </div>
    </nav>