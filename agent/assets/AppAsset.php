<?php
namespace agent\assets;

use yii\web\AssetBundle;

/**
 * 资源包管理器
 * @author chan <qq:429140141 tel:13251079793>
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'awesome/css/awesome.min.css',
        'css/animate.css',
        'css/style.css',
        /*自定义全局样式*/
        'css/ag.common.css'
    ];
    public $js = [
        /*Mainly*/
        'js/jquery-2.1.1.js',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        /*Custom and plugin javascript*/
        'js/inspinia.js',
        'js/plugins/pace/pace.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
