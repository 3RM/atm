<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AtmDeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="row">
    <div class="col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                //'city.name_ru',
                [
                    'attribute' => 'city_id',
                    'value' => function ($data) {
                        if ($data->city_id) {
                            return $data->city->name_ru;
                        }
                    },
                    'filter' => \kartik\select2\Select2::widget([
                        'name' => 'city_id',
                        'data' => \common\models\AtmCity::getCityList(),
                        'model' => $searchModel,
                        'attribute' => 'city_id',
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Выберите значение',
                        ],
                        'pluginOptions' => [
                            'asllowClear' => true,
                            'selectOnClose' => true,
                        ]
                    ]),
                ],
                //'street.name_ru',
                [
                    'attribute' => 'street_id',
                    'value' => function ($data) {
                        if ($data->street_id) {
                            return $data->street->name_ru;
                        }
                    },
                    'filter' => \kartik\select2\Select2::widget([
                        'name' => 'street_id',
                        'data' => \common\models\AtmStreet::getStreetList(),
                        'model' => $searchModel,
                        'attribute' => 'street_id',
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Выберите значение',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'selectOnClose' => true,
                        ]
                    ]),
                ],
                'full_address',
            ],
        ]); ?>
    </div>
</div>



