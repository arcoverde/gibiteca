<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Titulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="titulo-form">

	<?php yii\widgets\Pjax::begin(['id' => 'modal-form-titulo']) ?>
    <?php $form = ActiveForm::begin([
			'id' => 'titulo-form',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true,
			'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'id_categoria')->dropDownList(app\models\Categoria::getDataList(), []) ?>

    <?= $form->field($model, 'nome_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome_subtitulo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    	<button class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	<?php yii\widgets\Pjax::end(); ?>

</div>