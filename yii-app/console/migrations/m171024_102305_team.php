<?php

use yii\db\Migration;

class m171024_102305_team extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%team}}', [
            'id'          => $this->primaryKey(),
            'users_ids'   => $this->string()->notNull(), //might want to give it a default value
            'tickets_ids' => $this->string()->defaultValue(''),
            'description' => $this->string()->notNull(),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ticket}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171024_102305_team cannot be reverted.\n";

        return false;
    }
    */
}
