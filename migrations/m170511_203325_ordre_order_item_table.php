<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

class m170511_203325_ordre_order_item_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'phone' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_TEXT,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->createTable('{{%order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'price' => Schema::TYPE_MONEY,
            'product_id' => Schema::TYPE_INTEGER,
            'quantity' => Schema::TYPE_FLOAT,
        ], $tableOptions);

        $this->addForeignKey('fk-order_item-order_id-order-id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-order_item-product_id-product-id', '{{%order_item}}', 'product_id', '{{%product}}', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170511_203325_ordre_order_item_table cannot be reverted.\n";

        return false;
    }
    */
}
