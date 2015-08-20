<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'keywords', 'content' => '商家后台']);
$this->registerMetaTag(['name' => 'description', 'content' => '商家后台'], 'description');
$this->title= '代理系统-商家后台';
$this->params['breadcrumbs'][] = '';
AppAsset::register($this);
use yii\helpers\Url;
?>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">     
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a1.jpg">
                        <div class="m-t-xs font-bold">CEO</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong>Alex Johnatan</strong></h3>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </div>
                <div class="clearfix"></div>
                    </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a3.jpg">
                        <div class="m-t-xs font-bold">Marketing manager</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong>Monica Smith</strong></h3>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </div>
                <div class="clearfix"></div>
                    </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a4.jpg">
                        <div class="m-t-xs font-bold">Sales manager</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong>Michael Zimber</strong></h3>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </div>
                <div class="clearfix"></div>
                    </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a5.jpg">
                        <div class="m-t-xs font-bold">Graphics designer</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong>Sandra Smith</strong></h3>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </div>
                <div class="clearfix"></div>
                    </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="profile.html">
                <div class="col-sm-4">
                    <div class="text-center">
                        <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a6.jpg">
                        <div class="m-t-xs font-bold">Graphics designer</div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3><strong>Janet Carton</strong></h3>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                </div>
                <div class="clearfix"></div>
                    </a>
            </div>
        </div>
        
    </div>
    </div>
<?php $this->beginBlock('anima') ?>  
    $(function($) {  
      $('.contact-box').each(function() {
        animationHover(this, 'pulse');
        });  
    });  
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['anima'], \yii\web\View::POS_END); ?> 

  