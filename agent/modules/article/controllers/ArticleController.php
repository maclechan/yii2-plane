<?php
/**
 * 文章类别及文章管理
 * @author [chan] <[qq:429140141]>
 * @time(2015-8-5)
 */
namespace agent\modules\article\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use common\models\ArticleCate;
use common\models\Article;
use agent\components\Upload;

class ArticleController extends Controller
{
	//类别列表
    public function actionCatlist(){
        $model = new ArticleCate();//填充添加类别
    	//分页读取类别数据
		$cate = ArticleCate::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $cate->count(),
        ]);

        $cate = $cate->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('catlist', [
            'model' => $model,
            'cate' => $cate,
            'pagination' => $pagination,
        ]);
    }

    //添加类别
    public function actionCateadd(){
        $model = new ArticleCate();
        if($model->load(Yii::$app->request->post()) && $model -> save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['catlist']);
        }
    }

    //类别编辑
    public function actionCatedit()
    {
        $id = Yii::$app->request->post('id');
        $model = ArticleCate::findOne($id);
        if ($model === null) {
            Yii::$app->getSession()->setFlash("info",'编辑失败');
            return $this->redirect(['catlist']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', '编辑成功！');
            return $this->redirect(['catlist']);
        }
    }

    //类别删除
    public function actionCatedel($id){
        //该分类下面还包含分章，先删除分章
        $num = Article::find()->andWhere(['cid' => $id])->count('id');
        if($num != 0){
            Yii::$app->getSession()->setFlash("info",'该分类下面有内容，请先删除!');
            return $this->redirect(['catlist']);
        }else{
            $model = ArticleCate::findOne($id);
            if($model->delete()){
                Yii::$app->getSession()->setFlash('info', '操作删除成功！');
                return $this->redirect(['catlist']);
            }
        }
    }

    //文章列表
    public function actionArticlelist()
    {
        //分页读取类别数据
        $model = Article::find()->with('cate');
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $model->count(),
        ]);

        $model = $model->orderBy('id ASC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('artlist', [
            'model' => $model,
            'pagination' => $pagination,
        ]);
    }

    //添加文章
    public function actionArtadd(){
        $cate = ArticleCate::find()->all();//类别数据填充
        //添加文章
        $model = new Article();
        if ($model->load(Yii::$app->request->post())) {
            //上传文章封面图
            if($_FILES['Article']['name']['cover']){
                $img = Yii::$app->imgload->UploadPhoto($model,'uploads/article/','cover');
                $model->cover = $img;
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '添加成功！');
                    return $this->redirect(['articlelist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '添加失败！');
                    @unlink($img);
                    return $this->redirect(['articlelist']);
                }
            //不上传文章封面图
            }else{
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '添加成功！');
                    return $this->redirect(['articlelist']);
                }
            }
        }
        return $this->render('artadd',[
            'cate' => $cate,
            'model' => $model,
        ]);
    }

    //删除文章
    public function actionArtdel($id){
        $model = Article::findOne($id);
        if($model->delete()){ 
            if($model->cover){
                unlink($model->cover);
            }
            Yii::$app->getSession()->setFlash('info', '操作删除成功！');
            return $this->redirect(['articlelist']);
        }
    }

    //修改文章
    public function actionArtedit()
    {
        if(Yii::$app->request->get('id')){
            $id = Yii::$app->request->get('id');
            $cate = ArticleCate::find()->all();//类别数据填充
            $model = Article::findOne($id);
            
             return $this->render('artedit',[
                'id'=>$id,
                'cate' => $cate,
                'model' => $model,
            ]);
        } elseif(Yii::$app->request->post('id')){
            $id = Yii::$app->request->post('id');
            $model = Article::findOne($id);
            $cover = $model->cover;
            if ($model === null) {
                Yii::$app->getSession()->setFlash("info",'编辑失败');
                return $this->redirect(['articlelist']);
            }
            if ($model->load(Yii::$app->request->post())) {
                if($_FILES['Article']['name']['cover']){
                    //删除原图片
                    if($cover){
                        unlink($cover);
                    }
                    //更新新图片
                    $img = Yii::$app->imgload->UploadPhoto($model,'uploads/article/','cover');
                    $model->cover = $img;
                }else{
                    $model->cover = $cover;
                }
                if($model->save()){
                    Yii::$app->getSession()->setFlash('info', '编辑成功！');
                    return $this->redirect(['articlelist']);
                }else{
                    Yii::$app->getSession()->setFlash('info', '编辑失败！');
                    @unlink($img);
                    return $this->redirect(['articlelist']);
                }
            }
        }
    }
    /*public function actionUpload()
    {
        $cate = ArticleCate::find()->all();//类别数据填充
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $img = Yii::$app->imgload->UploadPhoto($model,'uploads/article/','cover');
            //var_dump($img);exit();
            $image =  UploadedFile::getInstance($model,'cover');//返回一个实例化对象
            //print_r($image);exit();
            $ext = $image->getExtension();//文件后缀名
            $imageName = time().rand(1000,9999).'.'.$ext;
            $image->saveAs('uploads/article/'.$imageName);
            $model->cover = 'uploads/article/'.$imageName;
            $model->cover = $img;
            if($model->save()){
                Yii::$app->getSession()->setFlash('info', '添加成功！');
                return $this->redirect(['articlelist']);
            }
        }
            return $this->render('artadd', ['model' => $model,'cate' => $cate,]);
    }*/
    
}
