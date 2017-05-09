<?php

use yii\db\Migration;

class m170412_173658_creat_product_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'categorie_id' => $this->integer(),
            'product' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text(),
            'image' => $this->string()->notNull(),

        ], $tableOptions);
        $this->addForeignKey('fk-product-categorie_id-categorie-id', '{{%product}}', 'categorie_id', '{{%categorie}}', 'id', 'CASCADE');

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
