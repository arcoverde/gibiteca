<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">
	<?php yii\widgets\Pjax::begin(['id' => 'modal-form-categoria']) ?>
    <?php $form = ActiveForm::begin([
			'id' => 'categoria-form',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true,
			'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    	<button class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	<?php yii\widgets\Pjax::end(); ?>
</div>
