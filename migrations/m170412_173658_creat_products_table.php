<?php

use yii\db\Migration;

class m170412_173658_creat_products_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'categorys_id' => $this->integer(),
            'parents_id' => $this->integer(),
            'image' => $this->string()->notNull(),
            'products_name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'description' => $this->text(),

        ], $tableOptions);
        $this->addForeignKey('fk-products-categorys_id-categorys_id', '{{%products}}', 'categorys_id', '{{%categorys}}', 'id', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('products');
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
