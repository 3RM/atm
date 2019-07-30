<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AtmDevice */

$this->title = 'Update Atm Device: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atm Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atm-device-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
