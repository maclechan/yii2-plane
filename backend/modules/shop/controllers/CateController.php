<?php
/**
 * 商家行业类别管理
 * @author [chan] <[qq:429140141]>
 * @time(2015-6-10)
 */
namespace backend\modules\shop\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\AgMcate;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CateController extends Controller
{
    //类别列表
    public function actionIndex()
    {
		$model = new AgMcate();//填充添加类别
		$model->status = 1;//填充单选值1默认选中

		//分页读取类别数据
		$cate = AgMcate::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $cate->count(),
        ]);

        $cate = $cate->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
        	'model' => $model,//填充添加类别
            'cate' => $cate,
            'pagination' => $pagination,
        ]);
    }
    
    //添加类别
    public function actionCateadd(){
    	$model = new AgMcate();
        if($model->load(Yii::$app->request->post()) && $model -> save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['index']);
        }
    }

    //类别编辑
    public function actionCatedit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgMcate::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['index']);
        }
    }

}
