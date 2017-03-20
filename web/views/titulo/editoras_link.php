<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Genero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="editora-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_editora')->dropDownList(app\models\Editora::getDataList(), []) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
