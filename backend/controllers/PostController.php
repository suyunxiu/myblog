<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        $model = Yii::$app->db->createCommand('select * from post')->queryAll();
//        $model = Yii::$app->db->createCommand('select * from post')->queryOne();
//        var_dump($model);
//        exit(0);

//        id=32 一条记录
//        $model = Post::find()->where(['id' => 32])->one();
//        $model = Post::findOne(32);

//        status=2 所有记录
//        $model = Post::find()->where(['status' => 2])->all();
//        $model = Post::findAll(['status' => 2]);

    /**
     * sql语句
     * and      ['and','id=1','id=2']       id=1 AND id=2
     * or       ['or','id=1','id=2']        id=1 OR id=2
     * in       ['in','id',[1,2,3]]         id IN(1,2,3)
     * between  ['between','id',1,10]       id BETWEEN 1 AND 10
     * like     ['like','name',['test','sample']]   name LIKE "%test%' AND name LIKE '%sample%'
     * 比较     ['>=','id',10]               id >= 10
     *
     */

    /**
     * Create插入
     * $post = new Post();
     * $post->title = '标题';
     * $post->content = '内容';
     * $post->save();  //等同 $post->insert();
     *
     * Update修改
     * $post = Post::findOne($id);
     * $post->title = '新标题';
     * $post->save(); //等同 $post->update();
     *
     * Delete删除
     * $post = Post::findOne($id);
     * $post->delete();
     */

//        $models = Post::find()->where(['AND',['status' => 2],['author_id' => 1],['like','title','Yii']])->orderBy('id')->all();
////        var_dump($post);
//        foreach ($models as $item){
//            echo $item->id . ' ';
//            echo $item->title . '<br>';
//        }
//        exit(0);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
