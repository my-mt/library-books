<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180624_205948_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'password' => 'string NOT NULL',
            'email' => 'string NOT NULL'
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
