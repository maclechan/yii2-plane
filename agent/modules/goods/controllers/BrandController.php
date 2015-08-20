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
use common\models\GoodsBrand;
use agent\components\Upload;
class BrandController extends Controller
{
    //品牌列表
    public function actionBrandlist(){
        //分页读取类别数据
        $brand = GoodsBrand::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $brand->count(),
        ]);
        $brand = $brand->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('brandlist', [
            'brand' => $brand,
            'pagination' => $pagination,
        ]);
    }
    //添加品牌
    public function actionBrandadd(){
        $model = new GoodsBrand();
        if($model->load(Yii::$app->request->post())){
            //上传文章封面图
            if($_FILES['GoodsBrand']['name']['logo']){
                $img = Yii::$app->imgload->UploadPhoto($model,'uploads/brand/','logo');
                $model->logo = $img;
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '添加成功！');
                    return $this->redirect(['brandlist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '添加失败！');
                    @unlink($img);
                    return $this->redirect(['brandlist']);
                }
            //不上传文章封面图
            }else{
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '添加成功！');
                    return $this->redirect(['brandlist']);
                }
            }
        }
        return $this->render('brandadd', [
            'model' => $model,
        ]);
    }
    
    //删除品牌
    public function actionBrandel($id){
        $model = GoodsBrand::findOne($id);
        if($model->delete()){ 
            if($model->logo){
                unlink($model->logo);
            }
            Yii::$app->getSession()->setFlash('info', '操作删除成功！');
            return $this->redirect(['brandlist']);
        }
    }
    //修改品牌
    public function actionBrandedit()
    {
        if(Yii::$app->request->get('id')){
            $id = Yii::$app->request->get('id');
            $model = GoodsBrand::findOne($id);
            
             return $this->render('brandedit',[
                'id'=>$id,
                'model' => $model,
            ]);
        } elseif(Yii::$app->request->post('id')){
            $id = Yii::$app->request->post('id');
            $model = GoodsBrand::findOne($id);
            $logo = $model->logo;
            if ($model === null) {
                Yii::$app->getSession()->setFlash("info",'编辑失败');
                return $this->redirect(['brandlist']);
            }
            if ($model->load(Yii::$app->request->post())) {
                if($_FILES['GoodsBrand']['name']['logo']){
                    //删除原图片
                    if($logo){
                        unlink($logo);
                    }
                    //更新新图片
                    $img = Yii::$app->imgload->UploadPhoto($model,'uploads/brand/','logo');
                    $model->logo = $img;
                }else{
                    $model->logo = $logo;
                }
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '编辑成功！');
                    return $this->redirect(['brandlist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '编辑失败！');
                    @unlink($img);
                    return $this->redirect(['brandlist']);
                }
            }
        }
    }
}