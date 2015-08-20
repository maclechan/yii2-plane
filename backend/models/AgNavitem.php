<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%navitem}}".
 *
 * @property integer $id
 * @property integer $nid
 * @property integer $nbid
 * @property string $cont
 * @property string $act_cn
 * @property string $act_en
 * @property integer $status
 * @property integer $sort
 */
class AgNavitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%navitem}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid', 'nbid'], 'required'],
            [['nid', 'nbid', 'status', 'sort'], 'integer'],
            [['cont', 'act_en'], 'string', 'max' => 32],
            [['act_cn'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           'id' => 'ID',
           'nid' => '对应一级菜单ID',
           'nbid' => '对应二级菜单ID',
           'cont' => '三级菜单控制器',
           'act_cn' => '三级菜单中文名',
           'act_en' => '三级菜单方法名',
           'status' => '状态(0隐藏,1开启)',
           'sort' => '排序',
        ];
    }
    /**
     * 通过二级导航关联一级导航
     */
    public function getNavbar()
    {
        return $this->hasOne(AgNavbar::className(), ['id' => 'nbid'])
            ->andWhere(['status' => 1]);//这里是navbar里status=1
    }

    public function getNav()
    {
        return $this->hasOne(AgNav::className(), ['id' => 'nid'])
                        ->via('navbar');
    }

}
