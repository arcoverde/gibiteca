<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Volume */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="volume-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-md-12">
        <strong>Título</strong><br>
        <div class="well well-sm"><?=$model->titulo->nome_titulo?></div>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'numero')->textInput() ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'data_mes')->dropDownList(\app\components\Helper::listMeses(), ['prompt' => 'Selecione']) ?>
    </div>
    <div class="col-md-2">
    <?= $form->field($model, 'data_ano')->dropDownList(\app\components\Helper::listAnos(1930), ['prompt' => 'Selecione']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'avaliacao')->dropDownList([1 => '*', 2 => '* *', 3 => '* * *', 4 => '* * * *', 5 => '* * * * *'], ['prompt' => 'Selecione']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'foi_lido')->textInput() ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-9">
        <?=
        $form->field($model, 'foto')
            ->widget(FileInput::classname(),
            [
                'options' => ['multiple' => false],
                'pluginOptions' => [
                    'browseLabel' => '&nbsp;Selecionar',
                    'showUpload' => false,
                    'removeLabel' => 'Remover',
                    'allowedFileExtensions' => ['jpg'],
                    'msgValidationError' => 'Arquivo inválido',
                    'msgInvalidFileExtension' => 'Arquivo inválido "{name}". Apenas arquivos "{extensions}" são permitidos.',
                ],
            ]); ?>
    </div>
    <div class="col-md-3">
        <?= Html::img("@web/upload/capas/{$model->id_volume}.jpg", ['width' => '100', 'height' => '150']) ?>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
