<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_081036_booking_fields_table extends Migration
{
    public function up()
    {
        $this->createTable('booking_fields', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING. ' NOT NULL',
            'value' => Schema::TYPE_STRING. ' NOT NULL',
            'booking_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->addForeignKey('booking_fields_key', 'booking_fields',
            'booking_id', 'booking', 'id');
    }

    public function down()
    {
        $this->dropTable('booking_fields');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
