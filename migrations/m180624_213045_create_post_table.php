<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180624_213045_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'post' => 'text',
            'user_id' => 'int'
            
        ]);
        $this->addForeignKey('post_user_id', 'post', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
