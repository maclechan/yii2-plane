<?php
namespace backend\components;
use backend\models\AgNav;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * 返回一级菜单数据
 * @author macle <qq:429140141>
 */
class NavWidget extends Widget
{
    public function run()
    {
        $nav = AgNav::find()
        ->where(['status' => 1])
        ->orderBy('id desc')
        ->all();
        foreach($nav as $_v){
            $navs[] = $_v->id.'|'.$_v->nav_cn.'|'.$_v->nav_en;
        }
        // 渲染的视图
         return $this->render('@app/views/site/_nav', [
             'nav'=>$navs,
         ]);
    }
}
