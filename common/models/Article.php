<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $title
 * @property string $desc
 * @property string $cover
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class Article extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid'], 'required'],
            [['title'], 'required','message'=>'标题不能为空！'],
            //[['cover'], 'required','message'=>'请上传文章封面图！'],
            [['cover'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
            [['cid'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['desc', 'cover'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => '文章类别',
            'title' => '文章标题',
            'desc' => '文章描述',
            'cover' => '文章封面',
            'content' => '文章内容',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }

    public function getCate(){
        return $this->hasOne(ArticleCate::className(),['id' => 'cid']);
    }
}
