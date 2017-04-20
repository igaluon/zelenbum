<?php

use yii\db\Migration;

class m170320_181059_creat_product_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'image' => $this->string(255)->notNull(),
            'images' => $this->string(255)->notNull(),
            'category' => $this->string(55)->notNull(),
            'category_name' => $this->string(55)->notNull(),
            'product_name' => $this->string(255)->notNull(),
            'description' => $this->string(500)->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('product');
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
