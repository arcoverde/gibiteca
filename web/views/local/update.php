<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = 'Update Local: ' . $model->id_local;
$this->params['breadcrumbs'][] = ['label' => 'Locals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_local, 'url' => ['view', 'id' => $model->id_local]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="local-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
