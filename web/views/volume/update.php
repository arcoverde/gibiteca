<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Volume */

$this->title = 'Update Volume: ' . $model->id_volume;
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_volume, 'url' => ['view', 'id' => $model->id_volume]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volume-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
