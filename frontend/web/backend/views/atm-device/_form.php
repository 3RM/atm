<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AtmDevice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atm-device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'street_id')->textInput() ?>

    <?= $form->field($model, 'full_address_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
