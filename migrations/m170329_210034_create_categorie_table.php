<?php

use yii\db\Migration;

class m170329_210034_create_categorie_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('categorie', [
            'id' => $this->primaryKey(),
            'categorie' => $this->string()->notNull(),
            'slug' => $this->string(),
            'parent_id' => $this->integer()->defaultValue(null),
        ], $tableOptions);

        $this->addForeignKey('fk-categorie-parent_id-categorie-id', '{{%categorie}}', 'parent_id', '{{%categorie}}', 'id', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('categorie');

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
