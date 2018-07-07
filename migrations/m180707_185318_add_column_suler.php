<?php

use yii\db\Migration;

/**
 * Class m180707_185318_add_column_suler
 */
class m180707_185318_add_column_suler extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'username', $this->text(225));
        $this->addColumn('user', 'status', $this->integer(2));
        $this->addColumn('user', 'auth_key', $this->text(225));
        $this->addColumn('user', 'secret_key', $this->text(225));
        $this->addColumn('user', 'created_at', $this->integer(10));
        $this->addColumn('user', 'updated_at', $this->integer(10));
        $this->renameColumn('user', 'password', 'password_hash');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180707_185318_add_column_suler cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180707_185318_add_column_suler cannot be reverted.\n";

        return false;
    }
    */
}
