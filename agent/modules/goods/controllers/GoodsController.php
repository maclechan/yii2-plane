<?php
/**
 * 商品类别管理、商品管理
 * @author [chan] <[qq:429140141]>
 * @time(2015-8-12)
 */
namespace agent\modules\goods\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use common\models\GoodsCategory;
use common\models\GoodsType;
use common\models\Attribute;
use common\models\GoodsAttr;
use common\models\GoodsBrand;
use common\models\Goods;
use agent\components\Upload;

class GoodsController extends Controller
{
    //类别列表
    public function actionCatlist(){
        $model = new GoodsCategory();
        //得到所有子孙数据
        $cate = $model->list_cate();
        return $this->render('catlist', [
            'cate' => $cate,
        ]);
    }

    //添加类别
    public function actionCatadd(){
        $model = new GoodsCategory();
        //得到所有子孙数据 填充到下拉列表
        $cate = $model->list_cate();
        if($model->load(Yii::$app->request->post())){
            if($model -> save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['catlist']);
            }else{
                Yii::$app->getSession()->setFlash('info', '添加失败！');
                return $this->redirect(['catlist']);
            }
        }
        return $this->render('catadd', [
            'model' => $model,
            'cate' => $cate,
        ]);
    }
    
    //类别删除 
    public function actionCatedel($id){
        //如果不是底层分类，则不允许删除
         $model = new GoodsCategory();
         $cate = $model->list_cate($id);
        if(empty($cate)){
            $model = GoodsCategory::findOne($id);
            if($model->delete()){
                Yii::$app->getSession()->setFlash('info', '删除成功！');
                return $this->redirect(['catlist']);
            }
        }else{
            Yii::$app->getSession()->setFlash("info",'该分类下面还包含其他分类，请先删除其子分类!');
            return $this->redirect(['catlist']);
        }
    }
    
    //修改类别
    public function actionCatedit()
    {
        //显示编辑表单
        if(Yii::$app->request->get('id')){
            $id = Yii::$app->request->get('id');
            //获取所有的分类信息以填充下拉列表
            $model = new GoodsCategory();
            $cate = $model->list_cate();

            #获取当前这条记录的信息
            $model = GoodsCategory::findOne($id);
            return $this->render('catedit',[
                'cat_id'=>$id,
                'cate' => $cate,
                'model' => $model,
            ]);

        //修改类别
        } elseif(Yii::$app->request->post('id')){
            $id = Yii::$app->request->post('id');
            //获取当前表单提交的cat_id下的所有后代分类
            $model = new GoodsCategory();
            $cate = $model->list_cate($id);

            //获取这些后代分类的cat_id
            $sub_ids = [];
            foreach ($cate as $v) {
                $sub_ids[] = $v['cat_id'];
            }
            //获取当前表单提交parent_id
            $pid = Yii::$app->request->post();
            $parent_id = $pid['GoodsCategory']['parent_id'];
            //判断所选的父分类是否为当前分类或其后代分类
            if ($parent_id == $id || in_array($parent_id, $sub_ids)) {
                    Yii::$app->getSession()->setFlash("info",'编辑失败,不能将分类放置到当前分类或其子分类!');
                    return $this->redirect(['catedit','id'=>$id]);
            } else {
                $model = GoodsCategory::findOne($id);
                if ($model === null) {
                    Yii::$app->getSession()->setFlash("info",'编辑失败');
                    return $this->redirect(['catlist']);
                }
                if ($model->load(Yii::$app->request->post())) {
                    if($model->save()){
                        Yii::$app->getSession()->setFlash('info', '编辑成功！');
                        return $this->redirect(['catlist']);
                    }else{
                        Yii::$app->getSession()->setFlash('info', '编辑失败！');
                        return $this->redirect(['catlist']);
                    }
                }
            }
               
        }
    }

    public function actionGoodslist(){
       return $this->render('goodslist');
    }

    //填充商品添加页面数据
    public function actionGoodsadd(){
        //获取商品类型及其属性
        $type = GoodsType::find()->all();
        //获取商品分类信息
        $category = new GoodsCategory();
        $cate = $category->list_cate();
        //获取商品品牌信息 
       $brand = GoodsBrand::find()->all();

        $model = new Goods();
        return $this->render('goodsadd',[
                'type' => $type,
                'cate'=>$cate,
                'brand' => $brand,
                'model' => $model,
        ]);
    }

    //商品添加
     public function actionGoodsave(){
        //var_dump(Yii::$app->request->post("Goods"));
        //var_dump(Yii::$app->request->post());exit();
        /*$attr_ids = Yii::$app->request->post('attr_id_list');//arr
        $attr_vals = Yii::$app->request->post('attr_value_list');//arr
        var_dump($attr_ids);
        var_dump($attr_vals);exit();*/

        $model = new Goods();

        if ($model->load(Yii::$app->request->post())) {
            //上传商品图片并成生缩略图
            if($_FILES['Goods']['name']['goods_img']){
                $imgs = Yii::$app->imgload->UploadPhoto($model,'uploads/goods/','goods_img',$isthumb=true);
                $img = explode('#',$imgs);
                $model->goods_img = $img[0];
                $model->goods_thumb = $img[1];
                if($model->save()){
                    //添加商品成功,获取属性并插入到商品属性关联表中
                    //获取新插入记录的id
                    $goods_id = $model->goods_id;
                    if($goods_id){
                        //实例化商品属性模型表
                        $attr = new GoodsAttr();
                        $attr_ids = Yii::$app->request->post('attr_id_list');
                        $attr_vals = Yii::$app->request->post('attr_value_list');
                        foreach ($attr_vals as $k => $v) {
                            if (!empty($v)) {
                                $attr -> goods_id = $goods_id;
                                $attr -> attr_id = $attr_ids[$k];
                                $attr -> attr_value = $v;
                                $attr -> save();
                            }   
                        }
                        Yii::$app->getSession()->setFlash('info', '添加商品属性成功！');
                        return $this->redirect(['goodslist']);
                    }else{
                        Yii::$app->getSession()->setFlash("info",'添加商品属性失败');
                        return $this->redirect(['goodslist']);
                    }  

                    Yii::$app->getSession()->setFlash('info', '添加商品成功！');
                    return $this->redirect(['goodslist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '添加失败！');
                    @unlink($model->goods_img);
                    @unlink($model->goods_thumb);
                    return $this->redirect(['goodslist']);
                }
            //不上传商品图片
            }else{
                if($model->save()){
                    //添加商品成功,获取属性并插入到商品属性关联表中
                    //获取新插入记录的id
                    $goods_id = $model->goods_id;
                    if($goods_id){
                        $attr_ids = Yii::$app->request->post('attr_id_list');
                        $attr_vals = Yii::$app->request->post('attr_value_list');
                        foreach ($attr_vals as $k => $v) {
                            if (!empty($v)) {
                                //实例化商品属性模型表
                                $attr = new GoodsAttr();
                                $attr->goods_id = $goods_id;
                                $attr->attr_id = $attr_ids[$k];
                                $attr->attr_value = $v;
                                $attr->save();
                            }  
                        }
                        /*$model = new Model();
                            foreach ($post['models'] as $key => $item) {
                                $model->isNewRecord = true;
                                $model->setAttributes($item);
                                $model->save();
                                $model->id = 0;
                        }*/
                        Yii::$app->getSession()->setFlash('info', '添加商品成功！');
                        return $this->redirect(['goodslist']);
                    }else{
                        Yii::$app->getSession()->setFlash("info",'添加商品属性失败');
                        return $this->redirect(['goodslist']);
                    }  

                    Yii::$app->getSession()->setFlash('info', '添加商品成功！');
                    return $this->redirect(['goodslist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '添加失败！');
                    return $this->redirect(['goodslist']);
                }
            }
        }
     }

    //ajax请求当前商品类型下的所有属性
    public function actionAjaxattr(){
        if(Yii::$app->request->post('type_id')){
            //获取类型id
            $type_id = Yii::$app->request->post('type_id');
            $attrs = Attribute::find()->where(['type_id' => $type_id])->all();
            //根据获取到的属性值构造html字符串
            $html = '';
            foreach ($attrs as $v) {
                $html .= "<div class='form-group'>";
                $html .= "<label class='col-lg-4 control-label'>".$v['attr_name']."</label>";
                $html .="<div class='col-lg-3'>";
                $html .= "<input type='hidden' name='attr_id_list[]' value='".$v['attr_id']."'>";
                switch ($v['attr_input_type']) {
                    case 0:
                        # 文本框
                        $html .= "<input name='attr_value_list[]'' type='text' size='40' class='form-control'>";
                        break;
                    case 1:
                        # 下拉列表
                        $arr = explode(PHP_EOL, $v['attr_value']);
                        $html .= "<select name='attr_value_list[]' class='form-control'>";
                        $html .= "<option value=''>请选择...</option>";
                        foreach ($arr as $v) {
                            $html .= "<option value='$v'>$v</option>";
                        }                                 
                        $html .= "</select>";
                        break;
                    case 2:
                        //多行文本框
                        $html .= "<textarea placeholder='...'' rows='4' name='attr_value_list[]' class='form-control'></textarea>";
                        break;
                    default:
                        $html .= "请选择商品类型";
                        break;
                }

                $html .="</div>";
                $html .="</div>";
            }
            echo $html;
        }
    }


}
