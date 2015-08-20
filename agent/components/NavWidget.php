<?php
namespace agent\components;
use common\models\AgMnav;
use common\models\AgMnavbar;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * 菜单栏
 * @author macle <qq:429140141>
 * @return $nav 
 */
class NavWidget extends Widget
{
    public function run()
    { 
        $nav = AgMnav::find()
        ->with('mbar')
        ->where(['status' => 1])
        ->orderBy('id asc')
        ->all();
        return $this->render('@app/views/site/_nav', [
            "nav"=>$nav,
         ]);
    }
}
