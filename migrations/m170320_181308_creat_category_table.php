<?php

use yii\db\Migration;

class m170320_181308_creat_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'category' => $this->string(55)->notNull(),
            'category_name' => $this->string(55)->notNull(),
            'parent_category' => $this->string(55)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('category');

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
