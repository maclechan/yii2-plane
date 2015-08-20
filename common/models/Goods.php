<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $goods_id
 * @property string $goods_sn
 * @property string $goods_name
 * @property string $goods_desc
 * @property string $seller_note
 * @property string $goods_content
 * @property integer $cat_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property string $promote_price
 * @property string $promote_start_time
 * @property string $promote_end_time
 * @property string $goods_img
 * @property string $goods_thumb
 * @property integer $goods_number
 * @property integer $warn_number
 * @property string $keywords
 * @property string $click_count
 * @property integer $type_id
 * @property integer $is_shipping
 * @property integer $is_promote
 * @property integer $is_best
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_onsale
 * @property string $created_at
 * @property string $updated_at
 */
class Goods extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    //自动更新商品时间和入库时间
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
            [['goods_name'], 'required','message'=>'商品名称不能为空！'],
            [['goods_name','market_price', 'shop_price', 'promote_price'], 'trim'],
            //[['cover'], 'required','message'=>'请上传文章封面图！'],
            [['goods_img'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
            [['goods_thumb'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
            //[['goods_content', 'created_at', 'updated_at'], 'required'],
            [['goods_content'], 'string'],
            [['cat_id', 'brand_id', 'promote_start_time', 'promote_end_time', 'goods_number', 'warn_number', 'click_count', 'type_id', 'is_shipping', 'is_promote', 'is_best', 'is_new', 'is_hot', 'is_onsale', 'created_at', 'updated_at'], 'integer'],
            [['market_price', 'shop_price', 'promote_price'], 'number'],
            [['goods_sn'], 'string', 'max' => 30],
            [['goods_name'], 'string', 'max' => 100],
            [['goods_desc', 'seller_note', 'goods_img', 'goods_thumb', 'keywords'], 'string', 'max' => 255],
            [['promote_start_time','promote_end_time'],'safe'],
            [['is_hot', 'is_new', 'is_best', 'is_promote', 'type_id', 'click_count', 'brand_id', 'promote_start_time', 'promote_end_time', 'goods_number', 'warn_number'], 'default', 'value' => 0],
            [['promote_price', 'market_price','shop_price'], 'default', 'value'=>'0.00'],
            [['is_onsale', 'is_shipping'], 'default', 'value' => 1],
            [['goods_content'], 'default', 'value'=>''],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品ID',
            'goods_sn' => '商品货号',
            'goods_name' => '商品名称',
            'goods_desc' => '商品简单描述',
            'seller_note' => '商家备注',
            'goods_content' => '商品详情',
            'cat_id' => '商品所属类别ID',
            'brand_id' => '商品所属品牌ID',
            'market_price' => '市场价',
            'shop_price' => '本店价格',
            'promote_price' => '促销价格',
            'promote_start_time' => '促销起始时间',
            'promote_end_time' => '促销截止时间',
            'goods_img' => '商品图片',
            'goods_thumb' => '商品缩略图',
            'goods_number' => '商品库存',
            'warn_number' => '库存警告数量',
            'keywords' => '商品关键词',
            'click_count' => '点击次数',
            'type_id' => '商品类型ID',
            'is_shipping' => '免运费商品0否,1是',
            'is_promote' => '是否促销，默认为0不促销',
            'is_best' => '是否精品,默认为0',
            'is_new' => '是否新品，默认为0',
            'is_hot' => '是否热卖,默认为0',
            'is_onsale' => '是否上架,默认为1',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }
}
