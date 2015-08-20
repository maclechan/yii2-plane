<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_attr}}".
 *
 * @property string $goods_attr_id
 * @property string $goods_id
 * @property integer $attr_id
 * @property string $attr_value
 * @property string $attr_price
 */
class GoodsAttr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'attr_id'], 'integer'],
            [['attr_price'], 'number'],
            [['attr_value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_attr_id' => '编号ID',
            'goods_id' => '商品ID',
            'attr_id' => '属性ID',
            'attr_value' => '属性值',
            'attr_price' => '属性价格',
        ];
    }
}
