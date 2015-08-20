<?php
/**
 * 商品类型管理、商品属性管理
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
use common\models\GoodsType;
use common\models\Attribute;
use common\models\GoodsAttr;

class GoodstypeController extends Controller
{
    //商品类型列表
    public function actionTypelist(){
        $model = new GoodsType();//填充添加商品类型
        //分页读取类别数据
        $type = GoodsType::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $type->count(),
        ]);

        $type = $type->orderBy('type_id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('typelist', [
            'model'=>$model,
            'type' => $type,
            'pagination' => $pagination,
        ]);
    }

    //添加商品类型
    public function actionTypeadd(){
        $model = new GoodsType();
        if($model->load(Yii::$app->request->post()) && $model -> save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['typelist']);
        }
    }

    //商品类型编辑
    public function actionTypedit()
    {
        $id = Yii::$app->request->post('id');
        $model = GoodsType::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['typelist']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['typelist']);
        }
    }
    
    //删除商品类型
    public function actionTypedel($id){
        $model = GoodsType::findOne($id);
        if($model->delete()){
            Attribute::deleteAll('type_id = :type_id', [':type_id' => $id,]);
            Yii::$app->getSession()->setFlash('info', '操作删除成功！');
            return $this->redirect(['typelist']);
        }
    }

    //商品属性列表
    public function actionAttrlist($type_id){
        $model = new GoodsType();//填充搜索商品类型
        //分页读取类别数据
        $attr = Attribute::find() ->where(['type_id' => $type_id])->with('type');
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $attr->count(),
        ]);

        $attr = $attr->orderBy('attr_id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('attrlist', [
            'type_id'=>$type_id,//便于返回时传参
            'model'=>$model,
            'attr' => $attr,
            'pagination' => $pagination,
        ]);
    }
    
     //添加商品属性
    public function actionAttradd($type_id){
        //添加成功后 商品属性列表页内容属于传过来的类型id
        if(Yii::$app->request->post('Attribute')){
            $attr = Yii::$app->request->post('Attribute');
            $type_id = $attr['type_id'];//商品类型id
        }
        $type = GoodsType::find()->all();//商品类型数据填充
        $model = new Attribute();
        if($model->load(Yii::$app->request->post())){
            if($model -> save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['attrlist','type_id'=>$type_id]);
            }else{
                Yii::$app->getSession()->setFlash('info', '添加失败！');
                return $this->redirect(['attrlist','type_id'=>$type_id]);
            }    
        }
        return $this->render('attradd', [
            'type_id'=>$type_id,//便于返回时传参
            'model'=>$model,
            'type' => $type,
        ]);
    }

    //修改商品属性
    public function actionAttredit(){
        if(Yii::$app->request->get('id')){
            $type = GoodsType::find()->all();//商品类型数据填充
            $id = Yii::$app->request->get('id');
            $type_id = Yii::$app->request->get('type_id');//商品类型id
            $model = Attribute::findOne($id);
            
             return $this->render('attredit',[
                'id'=>$id,
                'type_id'=>$type_id,
                'model' => $model,
                'type' => $type,
            ]);
        } elseif(Yii::$app->request->post('id')){
            $id = Yii::$app->request->post('id');
            $model = Attribute::findOne($id);
            if ($model === null) {
                Yii::$app->getSession()->setFlash("info",'编辑失败');
                return $this->redirect(['attrlist','type_id'=>$model->type_id]);
            }
            if ($model->load(Yii::$app->request->post())) {
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '编辑成功！');
                    return $this->redirect(['attrlist','type_id'=>$model->type_id]);
                }
            }
        }
    }

    //删除商品属性
    public function actionAttrdel($id,$type_id){
        $model = Attribute::findOne($id);
        if($model->delete()){
            Yii::$app->getSession()->setFlash('info', '操作删除成功！');
            return $this->redirect(['attrlist','type_id'=>$type_id]);
        }
    }
}
