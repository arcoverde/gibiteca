<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Volume */

$this->params['breadcrumbs'][] = ['label' => 'Títulos', 'url' => yii\helpers\Url::to(['titulo/index'])];
$this->params['breadcrumbs'][] = $model->titulo->nome_titulo;
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => ['index', 'id_titulo' => $model->id_titulo]];
$this->params['breadcrumbs'][] = 'Nº ' . $model->numero . sprintf(' (%02d/%04d)', $model->data_mes, $model->data_ano);
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="volume-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
