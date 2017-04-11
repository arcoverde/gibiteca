<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VolumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Títulos', 'url' => yii\helpers\Url::to(['titulo/index'])];
$this->params['breadcrumbs'][] = $titulo->nome_titulo;
$this->params['breadcrumbs'][] = 'Volumes';
?>
<div class="volume-index">

    <?= GridView::widget([
        'id' => 'volume-grid',
        'pjax' => true,
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'columns' => [
            #['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => false,
                'value' => function($model, $index, $widget) {
                    if (file_exists(Yii::getAlias("@app/upload/capas/{$model->id_volume}.jpg"))) {
                        return '<div class="image-hover">' . \yii\helpers\Html::img("@web/upload/capas/{$model->id_volume}.jpg", ['class' => 'image-mini']) . '</div>';
                    } else {
                        return '<div class="image-hover">' . \yii\helpers\Html::img("@web/images/sem-imagem.jpg", ['class' => 'image-mini']) . '</div>';
                    }
                },
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
                'width' => '80px;',
            ],
            [
                'attribute' => 'numero',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Data',
                'value' => function($model, $index, $widget) {
                    return sprintf('%02d/%04d', $model->data_mes, $model->data_ano);                    
                },
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'attribute' => 'avaliacao',
                'value' => function($model, $index, $widget) {
                    return str_repeat('<span class="glyphicon glyphicon-star text-info" aria-hidden="true"></span> ', $model->avaliacao) ;
                },
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'attribute' => 'foi_lido',
                'value' => function($model, $index, $widget) {
                    return $model->foi_lido ? '<span class="glyphicon glyphicon-ok text-info" aria-hidden="true"></span>' : '';
                },
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Tags',
                'value' => function($model, $index, $widget) {
                    $tags = '';
                    foreach ($model->tags as $tag) {
                        $tags .= '<span class="label label-default">' . $tag->nome . '</span> ';
                    }
                    return $tags;
                },
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Local',
                'attribute' => 'local.descricao',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'attribute' => 'observacao',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],

            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {delete} {tags}',
                'buttons' => [
                    'tags' => function($url, $model, $key) {
                        return '<a href="" class="tagIndex" id="' . $model->id_volume . '" title="Tags"><span class="glyphicon glyphicon-tags"></span></a>';
                    },
                ],
            ],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('Adicionar', ['create', 'id_titulo' => $titulo->id_titulo], ['class' => 'btn btn-success createData']) ?>
    </p>
    
    <!-- Modal para edicao -->
    <div class="modal fade" id="modal_window" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span><strong><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <em><span id="modal_titulo"></span></em></strong></span>
                </div>        
                <div class="modal-body" id="modal_window_body">
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
$this->registerJs("$('#modal_window').on('hidden.bs.modal', function(event) {
    $.pjax.reload({container:'#volume-grid-pjax'});
});");

#$this->registerJs("$('.tagIndex').on('click', function(event) {
$this->registerJs("$(document).on('click', '.tagIndex', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['volume/tags']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_titulo').html('Tags');
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");
?>