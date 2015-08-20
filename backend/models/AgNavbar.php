<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%navbar}}".
 *
 * @property integer $id
 * @property integer $nid
 * @property string $navbar_cn
 * @property integer $status
 * @property integer $sort
 */
class AgNavbar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%navbar}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid'], 'required'],
            [['nid', 'status', 'sort'], 'integer'],
            [['navbar_cn'], 'string', 'max' => 64]
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
               'navbar_cn' => '二级菜单中文名',
               'status' => '状态(0隐藏,1开启)',
               'sort' => '排序',
        ];
    }
    /**
     * 关联一级导航
     * 一对一关系
     *@param1：所关联模型类名称。
     *@param2：是一个数组，其中键为所关联的模型中的属性，值为当前模型中的属性。
     */
    public function getNav(){
        return $this->hasOne(AgNav::className(),['id' => 'nid']);
    }
    /**
     * 关联三级导航
     * 一对多关系
     */
    public function getNavitem(){
        return $this->hasMany(AgNavitem::className(),['nbid' => 'id']);
    }
}
