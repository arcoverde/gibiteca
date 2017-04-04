<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="link-table-index">

    <?= GridView::widget([
        'id' => 'tabela-link-grid',
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
                    'delete' => function($url, $model, $key) use ($volume) {
                        return '<a href="" class="unlinkData" id="' . $key . '" title="Excluir"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ],
            ],
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <form>
                <?=Html::dropDownList('data_select', null, $data_list, ['id'=>'data_select', 'class'=>'form-controll'])?>
                <button type="button" class="btn btn-success btn-xs linkData">
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
$this->registerJs("$('.linkData').on('click', function(event) {
        event.preventDefault();
        if (~$('#tabela-link-grid table tbody tr:first td:first').html().indexOf('Nenhum resultado')) {
            $('#tabela-link-grid table tbody tr:first').fadeOut(1000,function(){ 
                $('#tabela-link-grid table tbody tr:first').remove();
            });
        }
        
        $.ajax({
            type: 'GET',
            url: '" . yii\helpers\Url::to(["volume/{$action_prefix}-link"]) . "',
            data: {
                id_volume: ".$volume->id_volume.",
                id_link: $('#data_select').val(),
            },
            dataType: 'json',
            success: function(data)
            {
                var tabela = $('#tabela-link-grid table tbody');
                var numero = ((tabela.find('tr').size())%2 === 0)?'odd':'even';
                tabela.append('<tr class=\"'+numero+'\"> <td>'+data.nome+'</td><td class=\"kv-align-center kv-align-middle\"><a href=\"\" class=\"unlinkData\" id=\"'+data.id+'\" title=\"Excluir\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>');
            }
        });
});");

Dialog::widget();
$this->registerJs("$('.unlinkData').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        var _tr = $(this).closest('tr');
        krajeeDialog.confirm('Tem certeza que deseja excluir este item?', function (result) {
            if (result) {
                $.ajax({
                    type: 'GET',
                    url: '" . yii\helpers\Url::to(["volume/{$action_prefix}-unlink"]) . "',
                    data: {
                        id_volume: ".$volume->id_volume.",
                        id_link: id,
                    },
                    dataType: 'json',
                    success: function(data)
                    {
                        _tr.find('td').fadeOut(1000,function(){ 
                            _tr.remove();                    
                        }); 

                        console.log($('#tabela-link-grid table tbody').find('tr').size());
                        
                        if ($('#tabela-link-grid table tbody').find('tr').size() == 1) {
                            var tabela = $('#tabela-link-grid table tbody');
                            var numero = ((tabela.find('tr').size())%2 === 0)?'odd':'even';
                            tabela.append('<tr class=\"'+numero+'\"> <td colspan=\"2\">Nenhum resultado foi encontrado.</td></tr>');
                        }
                    }
                });
            }
        });
});");
?>