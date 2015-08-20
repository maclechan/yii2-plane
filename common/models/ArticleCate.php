<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article_cate}}".
 *
 * @property string $id
 * @property string $cname
 * @property string $desc
 */
class ArticleCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_cate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['cname', 'required','message'=>'类别不能为空!'],
            [['cname'], 'string', 'max' => 60],
            [['desc'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cname' => 'Cname',
            'desc' => 'Desc',
        ];
    }
}
