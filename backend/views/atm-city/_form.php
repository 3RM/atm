<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AtmCity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atm-city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
