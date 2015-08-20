<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%nav}}".
 *
 * @property integer $id
 * @property string $nav_cn
 * @property string $nav_en
 * @property integer $status
 * @property integer $sort
 */
class AgNav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort'], 'integer'],
            [['nav_cn'], 'string', 'max' => 64],
            [['nav_en'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           'id' => 'ID',
           'nav_cn' => '一级菜单中文名',
           'nav_en' => '一级菜单模块名',
           'status' => '状态(0隐藏,1开启)',
           'sort' => '排序',
        ];
    }

    /**
     * 关联二级导航
     */
    public function getNavbar(){
        return $this->hasMany(AgNavbar::className(),['nid' => 'id']);
    }

    /*public function search($params)  
    {  
        $query = Member::find();  
        $query->joinWith(['memdesc']); //加上这句 一看就知道这个就是连表的  
  
        $dataProvider = new ActiveDataProvider([  
            'query' => $query,  
        ]);  
  
        if (!($this->load($params) && $this->validate())) {  
            return $dataProvider;  
        }  
  
        $query->andFilterWhere([  
            'mid' => $this->mid,  
        ]);  
  
        $query->andFilterWhere(['like', 'memail', $this->memail])  
            ->andFilterWhere(['like', 'musername', $this->musername])  
        ->andFilterWhere(['like', 'm_memdesc.nickname', $this->nickname]) ;  //这个就是根据nickname参数进行搜索了，注意前面要加表名  
        return $dataProvider;  
    }
    
    controller
    public function actionIndex()  
   {  
       $searchModel = new MemberSearch();  
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  
  
       return $this->render('index', [  
           'searchModel' => $searchModel,  
           'dataProvider' => $dataProvider,  
       ]);  
   } 


   veiw
   
use yii\helpers\Html;  
use yii\grid\GridView;  
?>  
<div class="news-index">  
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?> //这个先不管它，咱们下回再说这个..  
    <p>  
  <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => 'Member',]), ['create'], ['class' => 'btn btn-success']) ?>  
    </p>  
  
    <?= GridView::widget([  
        'dataProvider' => $dataProvider,  
       'filterModel' => $searchModel,  
        'columns' => [  
            ['class' => 'yii\grid\SerialColumn'],  
  
            'memail',  
            'musername',  
         ['label'=>'nickname',  'attribute' => 'nickname',  'value' => 'memdesc.nickname' ],//加上这段代码  
  
            ['class' => 'yii\grid\ActionColumn'],  
        ],  
    ]); ?>  
  
</div> 

    */  
}
