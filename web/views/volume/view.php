<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Volume */

$this->title = $model->id_volume;
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volume-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_volume], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_volume], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_volume',
            'id_titulo',
            'numero',
            'data_mes',
            'data_ano',
            'avaliacao',
            'foi_lido',
            'observacao',
        ],
    ]) ?>

</div>
