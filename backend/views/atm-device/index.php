<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AtmDeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atm Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atm-device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->can('admin')): ?>
    <p>
        <?= Html::a('Refresh Atm List', ['refresh-atm-devices-list'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Это займёт некоторое время',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'city.name_ru',
            'street.name_ru',
            'full_address',
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
