<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VolumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Volumes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volume-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= $titulo->nome_titulo ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Volume', ['create', 'id_titulo' => $titulo->id_titulo], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Capa',
                'value' => function($model, $index, $widget) {
                    return '<div class="image-hover">' . \yii\helpers\Html::img("@web/upload/capas/{$model->id_volume}.jpg", ['class' => 'image-mini']) . '</div>';
                },
                'format' => 'html',
                'contentOptions' => ['style' => 'text-align: center; width: 80px;'],
            ],
            'numero',
            [
                'label' => 'Data',
                'value' => function($model, $index, $widget) {
                    return sprintf('%02d/%04d', $model->data_mes, $model->data_ano);                    
                }
            ],
            [
                'attribute' => 'avaliacao',
                'value' => function($model, $index, $widget) {
                    return str_repeat('<span class="glyphicon glyphicon-star text-info" aria-hidden="true"></span> ', $model->avaliacao) ;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'foi_lido',
                'value' => function($model, $index, $widget) {
                    return $model->foi_lido ? '<span class="glyphicon glyphicon-ok text-info" aria-hidden="true"></span>' : '';
                },
                'format' => 'html',
            ],
            'observacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
