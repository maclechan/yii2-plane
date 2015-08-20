<?php
/**
 * 导航栏设置
 * @author [chan] <[qq:429140141]>
 * @time(2015-5-31)
 */
namespace backend\modules\set\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\AgNav;
use backend\models\AgNavbar;
use backend\models\AgNavitem;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;


class DefaultController extends Controller
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

    //一级菜单列表
    public function actionIndex()
    {
        $nav = AgNav::find();

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

    //一级菜单添加
    public function actionNavadd()
    {
        $model = new AgNav();
        $request = Yii::$app->request;
        if($model->load($request->post())){
            $nav = $request->post('AgNav');
            if($nav['nav_cn'] == ' ' || $nav['nav_en'] == ' '){
                echo "<script>alert('不能为空值');history.back(-1);</script>";
            }else{
                $model -> save();
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['index']);
            }  
        }
    }

    //一级菜单编辑
    public function actionNavedit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgNav::findOne($id);
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
    //对应的二三级导航也全删除
    public function actionNavdel($id){
        $model = AgNav::findOne($id);
        if($model->delete()){
            AgNavbar::deleteAll("nid=$id");
            AgNavitem::deleteAll("nid=$id");
            Yii::$app->getSession()->setFlash('info', '删除成功！');
            return $this->redirect(['index']);
        }
    }

    //二级菜单列表
    public function actionNavbar()
    {
        //读出一级菜单,以便在增加二级菜单找到所属
        $nav = AgNav::find()->where(['status'=>1])->all();
        $navbar = AgNavbar::find()->with('nav');
        //分页数据
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $navbar->count(),
        ]);

        $navbar = $navbar->orderBy('nid ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('navbar', [
            'nav' => $nav,
            'navbar' => $navbar,
            'pagination' => $pagination,
        ]);
    }

    //二级菜单添加
    public function actionNavbaradd()
    {
        $model = new AgNavbar();
        $request = Yii::$app->request;
        if($model->load($request->post()) && $model->save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['navbar']); 
        }else{
            Yii::$app->getSession()->setFlash("info",'添加失败！');
            return $this->redirect(['navbar']);
        }
    }

    //二级菜单编辑
    public function actionBaredit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgNavbar::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['navbar']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['navbar']);
        }
    }

    //二级导航删除 
    //对应的三级导航也全删除
    public function actionNavbardel($id){
        $model = AgNavbar::findOne($id);
        if($model->delete()){
            AgNavitem::deleteAll("nbid=$id");
            Yii::$app->getSession()->setFlash('info', '删除成功！');
            return $this->redirect(['navbar']);
        }
    }

    //三级菜单列表
    public function actionNavitem()
    {
        //一级菜单数据在下拉表中展示
        $nav = AgNav::find()->where(['status'=>1])->all();
        $bar = AgNavbar::find()->where(['status'=>1])->all();
        $data = AgNavitem::find()->with('nav','navbar');
        $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $data->count(),
        ]);
        $navitem = $data->orderBy('nid asc')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('navitem', [
            'nav' => $nav,
            'bar' => $bar,
            'navitem' => $navitem,
            'pagination' => $pagination,
        ]);
    }
    /**
     *  ajax下拉二级菜单
     */ 
    public function actionAjaxbar(){
        if($_POST['nid']){
            $navbar = AgNavbar::find()
                ->where(['nid' => $_POST['nid']])
                ->orderBy('id')
                ->all();
            echo Json::encode($navbar);
        }
    }

    //三级菜单保存
    public function actionNavitemadd(){
        $model = new AgNavitem();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->getSession()->setFlash('info', '添加成功！');
            return $this->redirect(['navitem']); 
        }else{
            Yii::$app->getSession()->setFlash("info",'添加失败！');
            return $this->redirect(['navitem']);
        }
    }

    //三级导航删除 
    public function actionItemdel($id){
        $model = AgNavitem::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', '删除成功！');
        return $this->redirect(['navitem']);
    }

    //三级菜单编辑
    public function actionItemedit()
    {
        $id = Yii::$app->request->post('id');
        $model = AgNavitem::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['navitem']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['navitem']);
        }
    }

}
