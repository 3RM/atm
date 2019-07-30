<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "atm_device".
 *
 * @property int $id
 * @property int $city_id
 * @property int $street_id
 * @property string $full_address
 * @property int $created_at
 * @property int $updated_at
 */
class AtmDevice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atm_device';
    }

    public function __construct($city_id = null, $street_id = null, $full_address = null)
    {
        $this->city_id = $city_id;
        $this->street_id = $street_id;
        $this->full_address = $full_address;
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
            [['city_id'], 'required'],
            [['full_address'], 'string'],
            [['city_id', 'street_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'Город',
            'street_id' => 'Улица',
            'full_address' => 'Адрес',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Подготовка сохранения банкомата
     *
     * @param $data
     * @return AtmDevice
     */
    public static function prepareAtmSave($data)
    {
        $city_id = AtmCity::searchCityId($data['cityRU']);
        $street_id = AtmStreet::searchStreetId(AtmStreet::getRegExpStreetName($data['fullAddressRu']));

        $atm_device = new AtmDevice(
            $city_id,
            $street_id,
            $data['fullAddressRu']
        );

        return $atm_device;
    }

    /**
     * Связь с городом
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(AtmCity::className(), ['id' => 'city_id']);
    }

    /**
     * Связь улиц
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStreet()
    {
        return $this->hasOne(AtmStreet::className(), ['id' => 'street_id']);
    }

    /**
     * @return bool
     */
    public function refreshList()
    {
        /**
         * Чистка таблиц перед обновлением данных
         */
        $AtmService = new AtmService();

        foreach ($AtmService->db_tables as $table)
        {
            Yii::$app->db->createCommand()->truncateTable($table)->execute();
        }

        /**
         * Запрос и получение ответа из API
         */
        $response = $AtmService->getAtmData();

        /**
         * Обработка ответа от APIs
         * Сохранение городов, улиц, банкоматов.
         */
        if ($response->isOk)
        {
            /**
             * Получаем массив данных с банкоматами
             */
            $atms = $response->data;

            /**
             * Сохранение городов и улиц
             */
            foreach ($atms['devices'] as $atm)
            {
                AtmCity::prepareCitySave($atm)->save();
                AtmStreet::prepareStreetSave($atm)->save();
            }

            /**
             * Сохранение банкоматов в бд
             */
            foreach ($atms['devices'] as $atm)
            {
                self::prepareAtmSave($atm)->save();
            }
            return true;
        }
    }
}
