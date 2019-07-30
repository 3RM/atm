<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AtmStreet */

$this->title = 'Create Atm Street';
$this->params['breadcrumbs'][] = ['label' => 'Atm Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atm-street-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
