<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_071421_tour_fields_table extends Migration
{
    public function up()
    {
        $this->createTable('tour_fields', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING. ' NOT NULL',
            'sort' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'tour_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->addForeignKey('tour_field_key', 'tour_fields',
            'tour_id', 'tour', 'id');
    }

    public function down()
    {
        $this->dropTable('tour_fields');

        return false;
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
