<?php
namespace common\models;

use Yii;

/**
 * 商家一级导航
 * This is the model class for table "{{%mnav}}".
 *
 * @property integer $id
 * @property string $nav_cn
 * @property string $nav_en
 * @property integer $status
 * @property integer $sort
 */
class AgMnav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mnav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort'], 'integer'],
            [['nav_cn'], 'string', 'max' => 64],
            [['nav_en'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nav_cn' => '一级菜单中文名',
            'nav_en' => '一级菜单模块名',
            'status' => '状态(0隐藏,1开启)',
            'sort' => '排序',
        ];
    }

    /**
     * 关联二级导航
     */
    public function getMbar(){
        return $this->hasMany(AgMnavbar::className(),['pid' => 'id']);
    }
}
