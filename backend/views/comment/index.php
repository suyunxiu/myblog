<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p></p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            'id',
            [
                'attribute' => 'id',
                'contentOptions' => ['width' => '30px']
            ],
//            'content:ntext',
            [
                'attribute' => 'content',
                'value' => 'cutContent'
//                'value' => function($model)
//                    {
//                        $tmpStr = strip_tags($model->content);//去html标签
//                        $tmpLen = mb_strlen($tmpStr);//长度
//                        return mb_substr($tmpStr,0,10,'utf-8').(($tmpLen>10)?'...':'');
//                    }
            ],
//            'status',
            [
                'attribute' => 'status',
                'value' => 'status0.name',
                'contentOptions' => ['width' => '40px'],
                'filter' => \common\models\Commentstatus::find()
                        ->select(['name','id'])
                        ->orderBy('id')
                        ->indexBy('id')
                        ->column(),
                'contentOptions' => function($model)
                    {
                        return $model->status == 1?['class' => 'bg-danger']:[];
                    }
            ],
//            'create_time:datetime',
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'contentOptions' => ['width' => '150px']
            ],
//            'userid',
            [
                'attribute' => 'user.username',
                'label' => '用户',
                'value' => 'user.username',
                'contentOptions' => ['width' => '40px']
            ],
            //'email:email',
            //'url:url',
//            'post.title',
            [
                'attribute' => 'postTitle',
                'label' => '文章',
                'value' => 'post.title'
            ],
            //'remind',
            [
                'class' => '\yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {approve}',
                'buttons' => [
                        'approve' => function($url,$model,$key)
                                {
                                    $options = [
                                        'title' => Yii::t('yii', '审核'),
                                        'aria-label' => Yii::t('yii', '审核'),
                                        'data-confirm'=>Yii::t('yii','你确定通过这条评论吗？'),
                                        'data-method'=>'post',
                                        'data-pjax'=>'0',
                                    ];

                                    return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                                }
                ]
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
