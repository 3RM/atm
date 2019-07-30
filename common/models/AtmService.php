<?php
/**
 * Created by PhpStorm.
 * User: rodnoy
 * Date: 30.07.2019
 * Time: 11:41
 */

namespace common\models;
use yii\httpclient\Client;

/**
 *
 * @property array $db_tables
 */
class AtmService
{
    /**
     * Массив таблиц задействованных в работе с банкоматами
     * @var array
     */
    public $db_tables;

    public function __construct()
    {
        $this->db_tables = [
            AtmDevice::getTableSchema()->name,
            AtmCity::getTableSchema()->name,
            AtmStreet::getTableSchema()->name
        ];
    }

    /**
     * Получение данных из API
     * @return \yii\httpclient\Response
     */
    public function getAtmData()
    {
        $client = new Client();
        return $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.privatbank.ua/p24api/infrastructure')
            ->setData(['json' => '', 'atm' => '', 'address' => '', 'city' => ''])
            ->send();
    }
}