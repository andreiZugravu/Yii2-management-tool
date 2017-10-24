<?php

use yii\db\Migration;

class m171023_102713_ticket extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ticket}}', [
            'id'          => $this->primaryKey(),
            'users_ids'   => $this->string()->notNull(), //might want to give it a default value
            'team_id'     => $this->integer()->notNull(), //a ticket must be part of a single team
            'description' => $this->string()->notNull(),
            'deadline'    => $this->dateTime()->notNull(),
            'status'      => $this->integer()->notNull()->defaultValue(0),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
        ], $tableOptions);

        /* //Don't do this now, since users_ids is a string and the id of an user is a int
         $this->addForeignKey(
        'fk-user-tickets-id',
        'ticket',
        'users_ids',
        'user',
        'id' //could set $delete to 'CASCADE' but when a user gets deleted, we do not want to delete that ticket,
            //since the same ticket can be assigned to multiple users
            );
        */
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
        echo "m171023_102713_ticket cannot be reverted.\n";

        return false;
    }
    */
}
