<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_brand}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $desc
 * @property string $url
 * @property integer $sort
 * @property integer $is_show
 */
class GoodsBrand extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 50;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required','message'=>'品牌名称不能为空!'],
            [['logo'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
            [['sort', 'is_show'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['logo', 'desc', 'url'], 'string', 'max' => 255],
            ['sort', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'logo' => 'Logo',
            'desc' => 'Desc',
            'url' => 'Url',
            'sort' => 'Sort',
            'is_show' => 'Is Show',
        ];
    }
}
