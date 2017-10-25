<?php

use yii\db\Migration;

class m171025_133404_invite extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%invite}}', [
            'id'                         => $this->primaryKey(),
            'teams_ids'                  => $this->string()->notNull(),
            'user_id'                   => $this->integer()->notNull(),
            'created_at'                 => $this->integer()->notNull(),
            'updated_at'                 => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%invite}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171025_133404_invite cannot be reverted.\n";

        return false;
    }
    */
}
