<?php
/**
 * 商家管理
 * @author [chan] <[qq:429140141]>
 * @time(2015-6-13)
 */
namespace backend\modules\shop\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\AgMerch;
use common\models\AgMcate;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;

class ShopController extends Controller
{
	//商家列表
    public function actionIndex()
    {
		//分页读取类别数据
		$merch = AgMerch::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $merch->count(),
        ]);

        //数据导出
        $dataProvider = new ActiveDataProvider([
            'query' => $merch,
        ]);

        $merch = $merch->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'merch' => $merch,
            'pagination' => $pagination,
        ]);
    }

    //添加商家
    public function actionMerchadd(){
    	$mcate = AgMcate::find()->all();//行业类别数据填充
    	
    	//添加商家
    	$model = new AgMerch();
        if ($model->load(Yii::$app->request->post())) {
        	$model->setPassword($_POST['AgMerch']['password_hash']);
            $model->generateAuthKey();
            if($model->save()){
	            Yii::$app->getSession()->setFlash('info', '添加成功！');
	            return $this->redirect(['index']);
	        }
        }

    	return $this->render('merchadd',[
        	'mcate' => $mcate,
        	'model' => $model,
        ]);
    }

    public function actionList()
    {
       /* $model = new User();
        $dataProvider = new ActiveDataProvider([
        'query' => $model->find();
        'pagination' => [
             'pagesize' => '10',
         ]
       ]);*/
        $query = AgMerch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '1',
            ]
        ]);
        return $this->render('list', ['dataProvider' => $dataProvider]);
    }
}
