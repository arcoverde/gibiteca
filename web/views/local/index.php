<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'descricao',

            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {
                        return '<a href="" class="updateData" id="' . $model->id_local . '" title="Alterar"><span class="glyphicon glyphicon-pencil"></span></a>';
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
                    <span><strong><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <em>Local</em></strong></span>
                </div>        
                <div class="modal-body" id="modal_window_body">
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
$this->registerJs("$('.updateData').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['local/update']) . "',
            data: {id: id},
            success: function(data)
            {
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");

$this->registerJs("$('.createData').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['local/create']) . "',
            success: function(data)
            {
                $('#modal_window_body').html(data);
                $('#modal_window').modal();
            }
        });
});");
?>