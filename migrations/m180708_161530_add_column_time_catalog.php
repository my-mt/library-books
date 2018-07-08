<?php

use yii\db\Migration;

/**
 * Class m180708_161530_add_column_time_catalog
 */
class m180708_161530_add_column_time_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('catalog', 'created_at', $this->integer(10));
        $this->addColumn('catalog', 'updated_at', $this->integer(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180708_161530_add_column_time_catalog cannot be reverted.\n";

        $this->dropColumn('catalog', 'created_at');
        $this->dropColumn('catalog', 'created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180708_161530_add_column_time_catalog cannot be reverted.\n";

        return false;
    }
    */
}
