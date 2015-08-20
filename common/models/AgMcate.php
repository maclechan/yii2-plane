<?php

namespace common\models;

use Yii;

/**
 * 行业类别表
 * This is the model class for table "{{%mcate}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 */
class AgMcate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mcate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required','message'=>'类别名称不能为空!'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['name'], 'trim'],
            [['sort'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'sort' => '类别排序',
            'status' => '类别状态(0关闭 1开启)',
        ];
    }
}
