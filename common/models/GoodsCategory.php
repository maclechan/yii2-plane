<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property integer $cat_id
 * @property string $cat_name
 * @property integer $parent_id
 * @property string $keywords
 * @property string $cat_desc
 * @property integer $sort_order
 * @property integer $show_in_nav
 * @property integer $is_show
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['cat_name', 'required','message'=>'类别名称不能为空!'],
            [['parent_id', 'sort_order', 'show_in_nav', 'is_show'], 'integer'],
            [['cat_name'], 'string', 'max' => 30],
            [['keywords', 'cat_desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
            'parent_id' => 'Parent ID',
            'keywords' => 'Keywords',
            'cat_desc' => 'Cat Desc',
            'sort_order' => 'Sort Order',
            'show_in_nav' => 'Show In Nav',
            'is_show' => 'Is Show',
        ];
    }

    /**
     * @access public
     * @param $pid 节点的id
     * @param array 返回该节点的所有后代节点
     */
    public function list_cate($pid = 0){
        //以数组形式获取所有的记录
       $cates = GoodsCategory::find()->asArray()->all();
        //对类别进行重组，并返回
        return $this->_tree($cates,$pid);
    }

    /**
     *@access private
     *@param $arr array 要遍历的数组
     *@param $pid 节点的pid，默认为0，表示从顶级节点开始
     *@param $level int 表示层级 默认为0
     *@param array 排好序的所有后代节点
     */
    private function _tree($arr,$pid = 0,$level = 0){
        static $tree = []; //用于保存重组的结果,注意使用静态变量
        foreach ($arr as $v) {
            if ($v['parent_id'] == $pid){
                //说明找到了以$pid为父节点的子节点,将其保存
                $v['level'] = $level;
                $tree[] = $v;
                //然后以当前节点为父节点，继续找其后代节点
                $this->_tree($arr,$v['cat_id'],$level + 1);
            }
        }
        return $tree;
    }

}
