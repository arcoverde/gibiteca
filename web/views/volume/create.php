<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Volume */

$this->params['breadcrumbs'][] = ['label' => 'Títulos', 'url' => yii\helpers\Url::to(['titulo/index'])];
$this->params['breadcrumbs'][] = $titulo->nome_titulo;
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => yii\helpers\Url::to(['volume/index', 'id_titulo' => $titulo->id_titulo])];
$this->params['breadcrumbs'][] = 'Adicionar';
?>
<div class="volume-create">

    <?= $this->render('_form', [
        'model' => $model,
        'titulo' => $titulo,
    ]) ?>

</div>
