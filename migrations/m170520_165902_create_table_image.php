<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m170520_165902_create_table_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%image}}', [
            'id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-image-product_id-product_id', '{{%image}}', 'product_id', 'product', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
