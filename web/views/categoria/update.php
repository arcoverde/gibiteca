<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nome;
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="categoria-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
