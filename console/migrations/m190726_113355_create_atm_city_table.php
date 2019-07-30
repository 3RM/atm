<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%atm_city}}`.
 */
class m190726_113355_create_atm_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%atm_city}}', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(100)->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%atm_city}}');
    }
}
