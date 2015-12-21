<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_071222_tour_table extends Migration
{
    public function up()
    {
        $this->createTable('tour', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING. ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('tour');
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
