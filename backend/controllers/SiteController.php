<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;

use backend\models\AgNav;

/**
 * Site controller
 */
class SiteController extends Controller
{
   // public $layout = false;
   // public $defaultAction = 'home';
    /**
     * @inheritdoc
     * 动作过滤器
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    //其他所有未登陆用户可访问到的方法为login和error
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                       // 'roles' => ['?'],
                    ],
                    /**
                     * 有actions: 只有登陆用户可访问到的actions里定义的三个方法
                     * 没actions: 只有登陆用户可以访问所有方法
                     */
                    [
                        //'actions' => ['logout', 'index','macledo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            //VerbFilter检查请求动作的HTTP请求方式是什么
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //logou方法的请求方式为post
                    'logout' => ['post'],
                    'navbar' =>['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc 独立动作（action）
     * 定义控制器中重复使用通用动作
     */
    public function actions()
    {
        return [
            //error为动作(action)的名称
            'error' => [
                 //class为实现的动作的类
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // print_r(Yii::$app->db);exit();
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
