<?php
namespace common\models;

use Yii;

/**
 * 商家二级导航
 * This is the model class for table "{{%mnavbar}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $cont
 * @property string $act_cn
 * @property string $act_en
 * @property integer $status
 * @property integer $sort
 */
class AgMnavbar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mnavbar}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid'], 'required'],
            [['pid', 'status', 'sort'], 'integer'],
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
            'pid' => '对应一级菜单ID',
            'cont' => '二级菜单控制器',
            'act_cn' => '二级菜单中文名',
            'act_en' => '二级菜单方法名',
            'status' => '状态(0隐藏,1开启)',
            'sort' => '排序',
        ];
    }

    /**
     * 关联一级导航
     */
    public function getMnav(){
        return $this->hasOne(AgMnav::className(),['id' => 'pid']);
    }
}
