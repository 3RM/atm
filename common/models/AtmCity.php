<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "atm_city".
 *
 * @property int $id
 * @property string $name_ru
 * @property int $created_at
 * @property int $updated_at
 */
class AtmCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atm_city';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru'], 'required'],
            [['name_ru'], 'unique'],
            [['created_at', 'updated_at'], 'integer'],
            [['name_ru'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Название',
            'created_at' => 'Создано',
            'updated_at' => 'Обновленно',
        ];
    }

    /**
     * Возвращает id города
     *
     * @param string $city_name
     * @return int
     */
    public static function searchCityId(string $city_name)
    {
        return AtmCity::findOne(['name_ru' => $city_name])->id;
    }

    /**
     * Массив городов для Select2
     *
     * @return array
     */
    public static function getCityList()
    {
        return ArrayHelper::map(AtmCity::find()->all(), 'id', 'name_ru');
    }

    /**
     * Подготовка сохранения города
     *
     * @param $data
     * @return AtmCity
     */
    public static function prepareCitySave($data)
    {
        $atm_city = new AtmCity();

        $atm_city->name_ru = $data['cityRU'];

        return $atm_city;
    }
}
