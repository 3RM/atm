<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%atm_device}}`.
 */
class m190726_120007_create_atm_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%atm_device}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'street_id' => $this->integer(),
            'full_address' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%atm_device}}');
    }
}
