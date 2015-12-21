<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_073526_booking_table extends Migration
{
    public function up()
    {
        $this->createTable('booking', [
            'id' => Schema::TYPE_PK,
            'time' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'address' => Schema::TYPE_STRING. ' NOT NULL',
            'group_num' => Schema::TYPE_INTEGER . ' NOT NULL',
            'agency_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'adults' => Schema::TYPE_INTEGER . ' NOT NULL',
            'childs' => Schema::TYPE_INTEGER . ' NOT NULL',
            'infants' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tour_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'pick_up' => Schema::TYPE_INTEGER . ' NOT NULL',
            'drop_off' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->addForeignKey('tour_booking_key', 'booking',
            'tour_id', 'tour', 'id');
    }

    public function down()
    {
        $this->dropTable('booking');
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
