<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "atm_street".
 *
 * @property int $id
 * @property string $name_ru
 * @property int $created_at
 * @property int $updated_at
 */
class AtmStreet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atm_street';
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
            [['created_at', 'updated_at'], 'integer'],
            [['name_ru'], 'unique'],
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
            'name_ru' => 'Улица',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Получение id улицы по названию
     *
     * @param $street_name
     * @return mixed|null
     */
    public static function searchStreetId($street_name)
    {
        if($street_name) {
            return AtmStreet::find()->andFilterWhere(['like', 'name_ru', $street_name])->one()->id;
        }
        return NULL;
    }

    /**
     * Массив улиц для Select2
     *
     * @return array
     */
    public static function getStreetList()
    {
        return ArrayHelper::map(AtmStreet::find()->all(), 'id', 'name_ru');
    }

    /**
     * Поиск улицы по регулярному выражению
     *
     * @param $val
     * @return bool|string
     */
    public static function getRegExpStreetName($val)
    {
        preg_match('/,(улица|переулок|площадь|проспект|микрорайон|квартал|бульвар|шоссе|въезд|тупик|дорога|проезд)\s([\w\s-].*),(дом| дом| [\d]{1,3})/ui', $val, $matches);
        if($matches){
            return ($matches[1]." ".$matches[2]);
        }
        return false;
    }

    /**
     * Подготовка сохранения улицы
     *
     * @param $data
     * @return AtmStreet
     */
    public static function prepareStreetSave($data)
    {
        $atm_street = new AtmStreet();

        $atm_street->name_ru = AtmStreet::getRegExpStreetName($data['fullAddressRu']);

        return $atm_street;
    }
}
