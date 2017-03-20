<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TituloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Titulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titulo-index">

    <?php yii\widgets\Pjax::begin(['id' => 'titulo-grid-pjax']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => 'Categoria',
                'attribute' => 'categoria.nome',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'attribute' => 'nome_titulo',
                'value' => function($model, $index, $widget) {
                    return '<span>'.$model->nome_titulo.'</span><br><span class="text-muted"><small><em>'.$model->nome_subtitulo.'</em></small></span>';
                },
                'format' => 'html',
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
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Gêneros',
                'value' => function($model, $index, $widget) {
                    $generos = '';
                    foreach ($model->generos as $genero) {
                        $generos .= '<span class="label label-default">' . $genero->nome . '</span> ';
                    }
                    return $generos;
                },
                'format' => 'html',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Editoras',
                'value' => function($model, $index, $widget) {
                    $editoras = '';
                    foreach ($model->editoras as $editora) {
                        $editoras .= '<span class="label label-default">' . $editora->nome . '</span> ';
                    }
                    return $editoras;
                },
                'format' => 'html',
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],

            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {delete} {tags} {genero} {editora} {volumes}',
                'buttons' => [
                    'update' => function($url, $model, $key) {
                        return '<a href="" class="updateData" id="' . $model->id_titulo . '" title="Alterar"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'tags' => function($url, $model, $key) {
                        return '<a href="" class="tagIndex" id="' . $model->id_titulo . '" title="Tags"><span class="glyphicon glyphicon-tags"></span></a>';
                    },
                    'genero' => function($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-book" title="Gêneros"></span>', 
                                [yii\helpers\Url::to('generos'), 'id' => $key]);
                    },
                    'editora' => function($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-briefcase" title="Editoras"></span>', 
                                [yii\helpers\Url::to('editoras'), 'id' => $key]);
                    },
                    'volumes' => function($url, $model, $key) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-list-alt" title="Volumes"></span>', 
                                [yii\helpers\Url::to('volume/index'), 'id_titulo' => $key]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php yii\widgets\Pjax::end(); ?>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success createData']) ?>
    </p>

    <!-- Modal para edicao -->
    <div class="modal fade" id="modal_window" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span><strong><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <em>Tags</em></strong></span>
                </div>        
                <div class="modal-body" id="modal_window_body">
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs("$('.tagIndex').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/tags']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");
?>