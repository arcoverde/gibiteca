<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TituloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Titulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titulo-index">

    <?= GridView::widget([
        'id' => 'titulo-grid',
        'pjax' => true,
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
                'label' => '#',
                'attribute' => 'qtdVolumes',
                'hAlign' => GridView::ALIGN_CENTER,
                'vAlign' => GridView::ALIGN_MIDDLE,
            ],
            [
                'label' => 'Período',
                'attribute' => 'periodo',
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
                'label' => 'Gêneros',
                'value' => function($model, $index, $widget) {
                    $generos = '';
                    foreach ($model->generos as $genero) {
                        $generos .= '<span class="label label-default">' . $genero->nome . '</span> ';
                    }
                    return $generos;
                },
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
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
                'hAlign' => GridView::ALIGN_CENTER,
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
                        return '<a href="" class="generoIndex" id="' . $model->id_titulo . '" title="Gêneros"><span class="glyphicon glyphicon-book"></span></a>';
                    },
                    'editora' => function($url, $model, $key) {
                        return '<a href="" class="editoraIndex" id="' . $model->id_titulo . '" title="Editoras"><span class="glyphicon glyphicon-briefcase"></span></a>';
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

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success createData']) ?>
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
    $.pjax.reload({container:'#titulo-grid-pjax'});
});");

#$this->registerJs("$('.createData').on('click', function(event) {
$this->registerJs("$(document).on('click', '.createData', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/create']) . "',
            success: function(data)
            {
                $('#modal_titulo').html('Título');
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");

#$this->registerJs("$('.updateData').on('click', function(event) {
$this->registerJs("$(document).on('click', '.updateData', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/update']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_titulo').html('Título');
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");

#$this->registerJs("$('.tagIndex').on('click', function(event) {
$this->registerJs("$(document).on('click', '.tagIndex', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/tags']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_titulo').html('Tags');
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");

#$this->registerJs("$('.generoIndex').on('click', function(event) {
$this->registerJs("$(document).on('click', '.generoIndex', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/generos']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_titulo').html('Gênero');
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");

#$this->registerJs("$('.editoraIndex').on('click', function(event) {
$this->registerJs("$(document).on('click', '.editoraIndex', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/editoras']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_titulo').html('Editoras');
                $('#modal_window_body').html(data);
                $('#modal_window').modal({keyboard: false});
            }
        });
});");

?>