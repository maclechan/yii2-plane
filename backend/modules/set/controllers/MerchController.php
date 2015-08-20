<?php
/**
 * 商家后台导航管理
 * @author [chan] <[qq:429140141]>
 * @time(2015-6-16)
 */
namespace backend\modules\set\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\AgMnav;
use common\models\AgMnavbar;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class MerchController extends Controller
{
    public function behaviors()
    {
        return [
            //VerbFilter检查请求动作的HTTP请求方式是什么
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //logou方法的请求方式为post
                    //'ajaxbar' => ['post'],
                ],
            ],
        ];
    }

    //商家后台一级菜单列表
    public function actionIndex()
    {
        $nav = AgMnav::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $nav->count(),
        ]);

        $nav = $nav->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'nav' => $nav,
            'pagination' => $pagination,
        ]);
    }

    //商家后台一级菜单添加
    public function actionNavadd()
    {
        $model = new AgMnav();
        $request = Yii::$app->request;
        if($model->load($request->post())){
            $nav = $request->post('AgMnav');
            if($nav['nav_cn'] == ' ' || $nav['nav_en'] == ' '){
                echo "<script>alert('不能为空值');history.back(-1);</script>";
            }else{
                $model -> save();
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['index']);
            }  
        }
    }

    //商家后台一级菜单编辑
    public function actionNavedit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgMnav::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['index']);
        }
    }

    //一级导航删除 
    //对应的二级导航也全删除
    public function actionNavdel($id){
        $model = AgMnav::findOne($id);
        if($model->delete()){
            AgMnavbar::deleteAll("pid=$id");
            Yii::$app->getSession()->setFlash('info', '删除成功！');
            return $this->redirect(['index']);
        }
    }

    //商家后台二级菜单列表
    public function actionNavbar()
    {
        //读出一级菜单,以便在增加二级菜单找到所属
        $nav = AgMnav::find()->where(['status'=>1])->all();
        $navbar = AgMnavbar::find()->with('mnav');
        //分页数据
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $navbar->count(),
        ]);

        $navbar = $navbar->orderBy('pid ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('navbar', [
            'nav' => $nav,
            'navbar' => $navbar,
            'pagination' => $pagination,
        ]);
    }

    //商家后台二级菜单保存
    public function actionNavbaradd(){
        $model = new AgMnavbar();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->getSession()->setFlash('info', '添加成功！');
            return $this->redirect(['navbar']); 
        }else{
            Yii::$app->getSession()->setFlash("info",'添加失败！');
            return $this->redirect(['navbar']);
        }
    }

    //商家后台二级导航删除 
    public function actionBardel($id){
        $model = AgMnavbar::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', '删除成功！');
        return $this->redirect(['navbar']);
    }

    //商家后台二级菜单编辑
    public function actionBaredit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgMnavbar::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['navbar']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['navbar']);
        }
    }

}
