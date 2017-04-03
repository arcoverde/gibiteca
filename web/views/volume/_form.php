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
        <?= $form->field($model, 'foi_lido')->dropDownList([0 => 'Não', 1 => 'Sim']) ?>
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
    <?php if (file_exists(Yii::getAlias("@app/upload/capas/{$model->id_volume}.jpg"))): ?>
        <div class="col-md-3">
            <?= Html::img("@web/upload/capas/{$model->id_volume}.jpg", ['width' => '100', 'height' => '150']) ?>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
            <?php if ($model->isNewRecord): ?>
                <?= Html::submitButton('Gravar e Adicionar Outro', ['name' => 'adicionar', 'class' => 'btn btn-default']) ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if (Yii::$app->session->hasFlash('success')): ?>
<div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
</div>
<?php endif; ?>
