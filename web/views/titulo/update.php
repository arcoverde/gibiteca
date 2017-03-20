<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Titulo */

$this->title = 'Update Titulo: ' . $model->id_titulo;
$this->params['breadcrumbs'][] = ['label' => 'Titulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_titulo, 'url' => ['view', 'id' => $model->id_titulo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="titulo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
