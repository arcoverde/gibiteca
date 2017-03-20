<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Títulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $titulo->nome_titulo;
$this->params['breadcrumbs'][] = 'Tags';
?>
<div class="tag-index">

    <?php yii\widgets\Pjax::begin(['id' => 'tag-index-grid-pjax']) ?>
    <?= GridView::widget([
        'dataProvider' => $model,
        #'filterModel' => $searchModel,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'nome',

            [
                'class' => '\kartik\grid\ActionColumn',
                'header' => '',
                'width' => '30px',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url, $model, $key) use ($titulo) {
                        return '<a href="" class="unlinkTag" id="' . $key . '" title="Excluir"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php yii\widgets\Pjax::end(); ?>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success linkTag']) ?>
    </p>
    
</div>

<?php
$this->registerJs("$('.linkTag').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/tags-link']) . "',
            data: {id: ".$titulo->id_titulo."},
            success: function(data)
            {
                $('#link_tag_modal_window_body').html(data);
                $('#link_tag_modal_window').modal();
            }
        });
});");

Dialog::widget();
$this->registerJs("$('.unlinkTag').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        krajeeDialog.confirm('Tem certeza que deseja excluir este item?', function (result) {
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: '" . yii\helpers\Url::to(['titulo/tags-unlink']) . "',
                    data: {
                        id_titulo: ".$titulo->id_titulo.",
                        id_tag: id,
                    },
                    success: function(data)
                    {
                        $.pjax.reload({container:'#tag-index-grid-pjax'});
                    }
                });
            }
        });
});");
?>