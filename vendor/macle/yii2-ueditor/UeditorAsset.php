<?php
namespace macle\ueditor;

use yii\web\AssetBundle;
use macle;

class UeditorAsset extends AssetBundle{
    /*
     * @inheritdoc
     */
    public $sourcePath='@macle\ueditor\assets';

    public $css=[
        'css/ueditor.min.css',  
    ];
    
    public $js=[
		'js/ueditor.config.js',
		'js/ueditor.all.min.js',
		'js/lang/zh-cn/zh-cn.js',
    ];
    
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    
    public $publishOptions = ['forceCopy' => YII_DEBUG];
    
    private function getJs() {
        return [
            YII_DEBUG ? 'ueditor.all.js':'ueditor.all.min.js',
        ];
    }
    public function init() {
        if(empty($this->js)){
            $this->js=$this->getJs();
        }
        return parent::init();
    }
}
