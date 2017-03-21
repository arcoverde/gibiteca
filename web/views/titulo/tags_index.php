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

    <?= GridView::widget([
        'id' => 'tags-grid',
        'dataProvider' => $model,
        #'filterModel' => $searchModel,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'columns' => [
            #['class' => 'kartik\grid\SerialColumn'],

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

    <div class="panel panel-default">
        <div class="panel-body">
            <form>
                <?=Html::dropDownList('tags_select', null, app\models\Tag::getDataList(), ['id'=>'tags_select', 'class'=>'form-controll'])?>
                <button type="button" class="btn btn-success btn-xs linkTag">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </form>
        </div>
    </div>
    
    <p>
        <button class="btn btn-default" data-dismiss="modal">Fechar</button>
    </p>
    
</div>

<?php
$this->registerJs("$('.linkTag').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(['titulo/tags-link']) . "',
            data: {
                id_titulo: ".$titulo->id_titulo.",
                id_tag: $('#tags_select').val(),
            },
            dataType: 'json',
            success: function(data)
            {
                var tabela = $('#tags-grid table tbody');
                var numero = ((tabela.find('tr').size())%2 === 0)?'odd':'even';
                tabela.append('<tr class=\"'+numero+'\"> <td>'+data.nome+'</td><td class=\"kv-align-center kv-align-middle\"><a href=\"\" class=\"unlinkTag\" id=\"'+data.id+'\" title=\"Excluir\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>');
            }
        });
});");

Dialog::widget();
$this->registerJs("$('.unlinkTag').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        var _tr = $(this).closest('tr');
        krajeeDialog.confirm('Tem certeza que deseja excluir este item?', function (result) {
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: '" . yii\helpers\Url::to(['titulo/tags-unlink']) . "',
                    data: {
                        id_titulo: ".$titulo->id_titulo.",
                        id_tag: id,
                    },
                    dataType: 'json',
                    success: function(data)
                    {
                        _tr.find('td').fadeOut(1000,function(){ 
                            _tr.remove();                    
                        }); 
                    }
                });
            }
        });
});");
?>