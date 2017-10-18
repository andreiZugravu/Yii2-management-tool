<?php

use yii\db\Migration;

class m171018_110139_new_migration extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'test_column', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'test_column');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171018_110139_new_migration cannot be reverted.\n";

        return false;
    }
    */
}
