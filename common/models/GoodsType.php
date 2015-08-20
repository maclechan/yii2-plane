<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_type}}".
 *
 * @property integer $type_id
 * @property string $type_name
 */
class GoodsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['type_name', 'required','message'=>'商品类型名称不能为空!'],
            [['type_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
        ];
    }
}
