<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TituloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="titulo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_titulo') ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'nome_titulo') ?>

    <?= $form->field($model, 'nome_subtitulo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
