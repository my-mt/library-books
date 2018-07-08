<?php

use yii\db\Migration;

/**
 * Class m180708_172446_add_column_user_id_and_time
 */
class m180708_172446_add_column_user_id_and_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('author', 'created_at', $this->integer(10));
        $this->addColumn('author', 'updated_at', $this->integer(10));
        $this->addColumn('author', 'user_id', $this->integer(10)->notNull());
        
        $this->addColumn('place', 'created_at', $this->integer(10));
        $this->addColumn('place', 'updated_at', $this->integer(10));
        $this->addColumn('place', 'user_id', $this->integer(10)->notNull());
        
        $this->addColumn('post', 'created_at', $this->integer(10));
        $this->addColumn('post', 'updated_at', $this->integer(10));
        
        $this->addColumn('section', 'created_at', $this->integer(10));
        $this->addColumn('section', 'updated_at', $this->integer(10));
        $this->addColumn('section', 'user_id', $this->integer(10)->notNull());
        
        $this->addColumn('format', 'created_at', $this->integer(10));
        $this->addColumn('format', 'updated_at', $this->integer(10));
        $this->addColumn('format', 'user_id', $this->integer(10)->notNull());
        


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180708_172446_add_column_user_id_and_time cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180708_172446_add_column_user_id_and_time cannot be reverted.\n";

        return false;
    }
    */
}
