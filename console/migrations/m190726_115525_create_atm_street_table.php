<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%atm_street}}`.
 */
class m190726_115525_create_atm_street_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%atm_street}}', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(100),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%atm_street}}');
    }
}
