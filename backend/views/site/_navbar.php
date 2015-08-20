<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header member-c">
                    <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                         </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= Yii::$app->user->identity->username  ?></strong>
                         </span> <span class="text-muted text-xs block">超级管理员 <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="<?='/site/logout' ?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        A+
                    </div>
                </li>
                <?php 
                    if(isset($navbar)){ 
                        foreach ($navbar as $_v) {
                ?>  
                <li class="active">
                    <a><i class="fa fa-bars"></i> <span class="nav-label"><?= $_v['navbar_cn']?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php 
                            foreach ($_v->navitem as $item) {
                         ?>
                        <li class="active"><?= Html::a('<i class="fa fa-caret-right"></i>'.$item['act_cn'], ["/$naven/$item[cont]/$item[act_en]"/*,'fid' => $item->nid,'en'=>$naven*/]) ?></li>
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