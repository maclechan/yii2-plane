<?php
namespace backend\components;
use backend\models\AgNavbar;
use backend\models\AgNavitem;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * 根据传入的id返回二三级菜单数据
 * @author macle <qq:429140141>
 */
class NavbarWidget extends Widget
{
    public $fid;
    public $en;
    public function run()
    {
        if(isset($this->fid)){
            $navbar = AgNavbar::find()
            ->with('navitem')
            ->where(['status' => 1,'nid'=>$this->fid])
            ->orderBy('id asc')
            ->all();
        }else{
            $navbar = '';
        }
        return $this->render('@app/views/site/_navbar', [
            "navbar"=>$navbar,
            'naven' => $this->en,
         ]);
    }
}
