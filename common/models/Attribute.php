<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property integer $attr_id
 * @property string $attr_name
 * @property integer $type_id
 * @property integer $attr_type
 * @property integer $attr_input_type
 * @property string $attr_value
 * @property integer $sort_order
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['type_id', 'required','message'=>'请您选择该属性所属的商品类型!'],
            ['attr_name', 'required','message'=>'商品属性名称不能为空!'],
            [['type_id', 'attr_type', 'attr_input_type', 'sort_order'], 'integer'],
            [['attr_value'], 'string'],
            [['attr_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attr_id' => '商品属性ID',
            'attr_name' => '商品属性名称',
            'type_id' => '商品属性所属类型ID',
            'attr_type' => '属性是否可选 0 为唯一，1为单选，2为多选',
            'attr_input_type' => '属性录入方式 0为手工录入，1为从列表中选择，2为文本域',
            'attr_value' => '属性的值',
            'sort_order' => '属性排序依据',
        ];
    }

    //商品属性关联商品类型
    public function getType(){
        return $this->hasOne(GoodsType::className(),['type_id' => 'type_id']);
    }
}
