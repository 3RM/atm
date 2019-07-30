<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AtmCity */

$this->title = 'Create Atm City';
$this->params['breadcrumbs'][] = ['label' => 'Atm Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atm-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
