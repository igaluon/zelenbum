<?php

use yii\db\Migration;

class m170329_210034_create_categorys_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('categorys', [
            'id' => $this->primaryKey(),
            'category' => $this->string()->notNull(),
            'category_name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'parent_id' => $this->integer()->defaultValue(null),
        ], $tableOptions);
        $this->addForeignKey('fk-categorys-parent_id-categorys-id', '{{%categorys}}', 'parent_id', '{{%categorys}}', 'id', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('categorys');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {r
    }
    */
}
