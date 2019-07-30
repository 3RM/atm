<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AtmDevice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atm-device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_address')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
